<?php

namespace Ncanode\Controller\X509;

use Ncanode\Controller\LayoutController;
use Project\Service\Ncanode;

class InfoController extends LayoutController
{
    public function get()
    {
        $cert = (string) $this->f('cert');
        $verify_ocsp = (bool) $this->f('verify_ocsp', false);
        $verify_crl = (bool) $this->f('verify_crl', false);

        $this->validateNotEmpty($cert, 'cert');

        /** @var Ncanode $ncanode */
        $ncanode = $this->s('ncanode');

        $response = $ncanode->x509Verify($cert, $verify_ocsp, $verify_crl);

        $this->setContent($response);
    }
}
