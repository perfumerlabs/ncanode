<?php

namespace Ncanode\Controller;

use Project\Service\Ncanode;

class ValidateController extends LayoutController
{
    public const RULES = [
        'iin',
        'bin',
        'auth',
        'sign',
        'individual',
        'employee',
        'ceo',
        'organisation',
    ];

    public function post()
    {
        $cms        = (string) $this->f('cms');
        $xml        = (string) $this->f('xml');
        $iin        = (string) $this->f('iin');
        $bin        = (string) $this->f('bin');
        $rules      = $this->f('rule');
        $expiration = (bool) $this->f('expiration', true);
        $criteria   = (string) $this->f('criteria', 'and');

        if (!$rules) {
            $this->forward(
                'error',
                'badRequest',
                [$this->t('error.rules_invalid') . ' ' . implode(', ', self::RULES)]
            );
        }

        if (!is_array($rules)) {
            $rules = [$rules];
        }

        $verify_ocsp = true;
        $verify_crl  = true;

        if (!$expiration) {
            $verify_ocsp = false;
            $verify_crl  = false;
        }

        if (!$cms && !$xml) {
            $this->forward('error', 'badRequest', [$this->t('error.cms_or_xml_required')]);
        }

        if ($cms && $xml) {
            $this->forward('error', 'badRequest', [$this->t('error.only_cms_or_xml_required')]);
        }

        /** @var Ncanode $ncanode */
        $ncanode = $this->s('ncanode');

        try {
            if ($cms) {
                $legal       = $ncanode->isCertificateLegal($cms, $verify_ocsp, $verify_crl);
                $not_expired = $ncanode->isCertificateNotExpired($cms, $verify_ocsp, $verify_crl);
            } else {
                $legal       = $ncanode->isXmlCertificateLegal($xml, $verify_ocsp, $verify_crl);
                $not_expired = $ncanode->isXmlCertificateNotExpired($xml, $verify_ocsp, $verify_crl);
            }

            if (!$legal) {
                $this->forward('error', 'badRequest', [$this->t('error.certificate_not_legal')]);
            }

            if (!$not_expired) {
                $this->forward('error', 'badRequest', [$this->t('error.certificate_is_expired')]);
            }

            $statues = [];

            foreach ($rules as $rule) {
                if (!in_array($rule, self::RULES)) {
                    $this->forward(
                        'error',
                        'badRequest',
                        [$this->t('error.rules_invalid') . ' ' . implode(', ', self::RULES)]
                    );
                }

                if ($rule === 'iin') {
                    $this->validateNotEmpty($iin, 'iin');

                    if ($cms) {
                        $sign_iin = $ncanode->getIin($cms, $verify_ocsp, $verify_crl);
                    } else {
                        $sign_iin = $ncanode->getIinByXml($xml, $verify_ocsp, $verify_crl);
                    }

                    $statues[] = $sign_iin === $iin;
                } elseif ($rule === 'bin') {
                    $this->validateNotEmpty($bin, 'bin');

                    if ($cms) {
                        $sign_bin = $ncanode->getBin($cms);
                    } else {
                        $sign_bin = $ncanode->getBinByXml($xml);
                    }

                    $statues[] = $sign_bin === $bin;
                } elseif ($rule === 'auth') {
                    $this->validateNotEmpty($cms, 'cms');
                    $statues[] = $ncanode->isAuthCertificate($cms, $verify_ocsp, $verify_crl);
                } elseif ($rule === 'sign') {
                    $this->validateNotEmpty($cms, 'cms');
                    $statues[] = $ncanode->isSignCertificate($cms, $verify_ocsp, $verify_crl);
                } elseif ($rule === 'individual') {
                    if ($cms) {
                        $statues[] = $ncanode->isIndividual($cms, $verify_ocsp, $verify_crl);
                    } else {
                        $statues[] = $ncanode->isIndividualByXml($xml, $verify_ocsp, $verify_crl);
                    }
                } elseif ($rule === 'employee') {
                    if ($cms) {
                        $statues[] = $ncanode->isEmployee($cms, $verify_ocsp, $verify_crl);
                    } else {
                        $statues[] = $ncanode->isEmployeeByXml($xml, $verify_ocsp, $verify_crl);
                    }
                } elseif ($rule === 'ceo') {
                    if ($cms) {
                        $statues[] = $ncanode->isCeo($cms, $verify_ocsp, $verify_crl);
                    } else {
                        $statues[] = $ncanode->isCeoByXml($xml, $verify_ocsp, $verify_crl);
                    }
                } elseif ($rule === 'organisation') {
                    if ($cms) {
                        $statues[] = $ncanode->isOrganization($cms, $verify_ocsp, $verify_crl);
                    } else {
                        $statues[] = $ncanode->isOrganizationByXml($xml, $verify_ocsp, $verify_crl);
                    }
                }
            }

            $status = false;
            if (in_array(true, $statues)) {
                if ($criteria === 'or' || $criteria === 'and' && !in_array(false, $statues)) {
                    $status = true;
                }
            }

            $this->setStatus($status);
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
