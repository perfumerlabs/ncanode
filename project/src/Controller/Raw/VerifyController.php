<?php

namespace Ncanode\Controller\Raw;

use Ncanode\Controller\LayoutController;
use Project\Service\Ncanode;

class VerifyController extends LayoutController
{
    public function get()
    {
        $cms = (string) $this->f('cms');
        $verify_ocsp = (bool) $this->f('verify_ocsp', false);
        $verify_crl = (bool) $this->f('verify_crl', false);

        $this->validateNotEmpty($cms, 'cms');

        /** @var Ncanode $ncanode */
        $ncanode = $this->s('ncanode');

        $response = $ncanode->rawVerify($cms, $verify_ocsp, $verify_crl);

        $this->setContent($response);
    }
}
