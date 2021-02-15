<?php

namespace Ncanode\Controller\Cms;

use Ncanode\Controller\LayoutController;
use Project\Service\Ncanode;

class VerifyController extends LayoutController
{
    public function get()
    {
        $cms = (string) $this->f('cms');
        $check_ocsp = (bool) $this->f('check_ocsp', false);
        $check_crl = (bool) $this->f('check_crl', false);

        $this->validateNotEmpty($cms, 'cms');

        /** @var Ncanode $ncanode */
        $ncanode = $this->s('ncanode');

        $response = $ncanode->cmsVerify($cms, $check_ocsp, $check_crl);

        $this->setContent($response);
    }
}
