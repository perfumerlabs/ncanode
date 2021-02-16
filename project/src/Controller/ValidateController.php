<?php

namespace Ncanode\Controller;

use Project\Service\Ncanode;

class ValidateController extends LayoutController
{
    public const RULES = [
        'iin',
        'bin',
        'auth',
        'individual',
        'employee',
        'ceo',
        'organisation',
    ];

    public function post()
    {
        $cms         = (string) $this->f('cms');
        $xml         = (string) $this->f('xml');
        $iin         = (string) $this->f('iin');
        $bin         = (string) $this->f('bin');
        $rule        = (string) $this->f('rule');
        $verify_ocsp = (bool) $this->f('verify_ocsp', true);
        $verify_crl  = (bool) $this->f('verify_crl', true);

        if (!$cms && !$xml) {
            $this->forward('error', 'badRequest', ["CMS or XML parameter must be set"]);
        }

        if ($cms && $xml) {
            $this->forward('error', 'badRequest', ["Only one of CMS or XML parameter must be set"]);
        }

        if (!in_array($rule, self::RULES)) {
            $this->forward('error', 'badRequest', ["Rule parameter must be one of " . implode(', ', self::RULES)]);
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
                $this->forward('error', 'badRequest', ["Certificate is not legal"]);
            }

            if (!$not_expired) {
                $this->forward('error', 'badRequest', ["Certificate is expired"]);
            }

            $result = false;

            if ($rule === 'iin') {
                $this->validateNotEmpty($iin, 'iin');

                if ($cms) {
                    $sign_iin = $ncanode->getIin($cms, $verify_ocsp, $verify_crl);
                } else {
                    $sign_iin = $ncanode->getIinByXml($xml, $verify_ocsp, $verify_crl);
                }

                if ($sign_iin === $iin) {
                    $result = true;
                }
            } elseif ($rule === 'bin') {
                $this->validateNotEmpty($bin, 'bin');

                if ($cms) {
                    $sign_bin = $ncanode->getBin($cms);
                } else {
                    $sign_bin = $ncanode->getBinByXml($xml);
                }

                if ($sign_bin === $bin) {
                    $result = true;
                }
            } elseif ($rule === 'auth') {
                $this->validateNotEmpty($cms, 'cms');
                $result = $ncanode->isAuthCertificate($cms, $verify_ocsp, $verify_crl);
            } elseif ($rule === 'individual') {
                if ($cms) {
                    $result = $ncanode->isIndividual($cms, $verify_ocsp, $verify_crl);
                } else {
                    $result = $ncanode->isIndividualByXml($xml, $verify_ocsp, $verify_crl);
                }
            } elseif ($rule === 'employee') {
                if ($cms) {
                    $result = $ncanode->isEmployee($cms, $verify_ocsp, $verify_crl);
                } else {
                    $result = $ncanode->isEmployeeByXml($xml, $verify_ocsp, $verify_crl);
                }
            } elseif ($rule === 'ceo') {
                if ($cms) {
                    $result = $ncanode->isCeo($cms, $verify_ocsp, $verify_crl);
                } else {
                    $result = $ncanode->isCeoByXml($xml, $verify_ocsp, $verify_crl);
                }
            } elseif ($rule === 'organisation') {
                if ($cms) {
                    $result = $ncanode->isOrganization($cms, $verify_ocsp, $verify_crl);
                } else {
                    $result = $ncanode->isOrganizationByXml($xml, $verify_ocsp, $verify_crl);
                }
            }

            $this->setContent(['result' => $result]);
        } catch (\Throwable $e) {
            $this->forward('error', 'internalServerError', [$e]);
        }
    }
}
