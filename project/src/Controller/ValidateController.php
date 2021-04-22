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

            $statuses = [];

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
                        $sign_iin = $ncanode->getIinFromX509($cms, $verify_ocsp, $verify_crl);
                    } else {
                        $sign_iin = $ncanode->getIinByXml($xml, $verify_ocsp, $verify_crl);
                    }

                    $res = $sign_iin === $iin;

                    error_log('[CUSTOM LOG] rule iin ' . $iin . ' status = ' . $res . ', cms_iin = ' . $sign_iin . ';' . PHP_EOL);

                    $statuses[] = $res;
                } elseif ($rule === 'bin') {
                    $this->validateNotEmpty($bin, 'bin');

                    if ($cms) {
                        $sign_bin = $ncanode->getBinByX509($cms);
                    } else {
                        $sign_bin = $ncanode->getBinByXml($xml);
                    }

                    $res = $sign_bin === $bin;

                    error_log('[CUSTOM LOG] rule bin ' . $rule . ' status = ' . $res . ';' . PHP_EOL);

                    $statuses[] = $res;
                } elseif ($rule === 'auth') {
                    $this->validateNotEmpty($cms, 'cms');

                    $res = $ncanode->isAuthCertificate($cms, $verify_ocsp, $verify_crl);

                    error_log('[CUSTOM LOG] rule auth status = ' . $res . ';' . PHP_EOL);

                    $statuses[] = $res;
                } elseif ($rule === 'sign') {
                    $this->validateNotEmpty($cms, 'cms');

                    $res = $ncanode->isSignCertificate($cms, $verify_ocsp, $verify_crl);

                    error_log('[CUSTOM LOG] rule sign status = ' . $res . ';' . PHP_EOL);

                    $statuses[] = $res;
                } elseif ($rule === 'individual') {
                    if ($cms) {
                        $res = $ncanode->isIndividual($cms, $verify_ocsp, $verify_crl);
                    } else {
                        $res = $ncanode->isIndividualByXml($xml, $verify_ocsp, $verify_crl);
                    }

                    error_log('[CUSTOM LOG] rule individual status = ' . $res . ';' . PHP_EOL);

                    $statuses[] = $res;
                } elseif ($rule === 'employee') {
                    if ($cms) {
                        $res = $ncanode->isEmployee($cms, $verify_ocsp, $verify_crl);
                    } else {
                        $res = $ncanode->isEmployeeByXml($xml, $verify_ocsp, $verify_crl);
                    }

                    error_log('[CUSTOM LOG] rule employee status = ' . $res . ';' . PHP_EOL);

                    $statuses[] = $res;
                } elseif ($rule === 'ceo') {
                    if ($cms) {
                        $res = $ncanode->isCeo($cms, $verify_ocsp, $verify_crl);
                    } else {
                        $res = $ncanode->isCeoByXml($xml, $verify_ocsp, $verify_crl);
                    }

                    error_log('[CUSTOM LOG] rule ceo status = ' . $res . ';' . PHP_EOL);

                    $statuses[] = $res;
                } elseif ($rule === 'organisation') {
                    if ($cms) {
                        $res = $ncanode->isOrganization($cms, $verify_ocsp, $verify_crl);
                    } else {
                        $res = $ncanode->isOrganizationByXml($xml, $verify_ocsp, $verify_crl);
                    }

                    error_log('[CUSTOM LOG] rule organisation status = ' . $res . ';' . PHP_EOL);

                    $statuses[] = $res;
                }
            }

            $status = false;
            if (in_array(true, $statuses)) {
                if ($criteria === 'or' || $criteria === 'and' && !in_array(false, $statuses)) {
                    $status = true;
                }
            }

            $this->setStatus($status);
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
