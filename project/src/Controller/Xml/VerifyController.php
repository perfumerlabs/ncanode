<?php

namespace Ncanode\Controller\Xml;

use Ncanode\Controller\LayoutController;
use Project\Service\Ncanode;

class VerifyController extends LayoutController
{
    public function get()
    {
        $xml = (string) $this->f('xml');
        $verify_ocsp = (bool) $this->f('verify_ocsp', false);
        $verify_crl = (bool) $this->f('verify_crl', false);

        $this->validateNotEmpty($xml, 'xml');

        /** @var Ncanode $ncanode */
        $ncanode = $this->s('ncanode');

        $response = $ncanode->xmlVerify($xml, $verify_ocsp, $verify_crl);

        $this->setContent($response);
    }
}
