<?php

namespace Ncanode\Controller\Cms;

use Ncanode\Controller\LayoutController;
use Project\Service\Ncanode;

class ExtractController extends LayoutController
{
    public function get()
    {
        $cms = (string) $this->f('cms');

        $this->validateNotEmpty($cms, 'cms');

        /** @var Ncanode $ncanode */
        $ncanode = $this->s('ncanode');

        $response = $ncanode->cmsExtract($cms);

        $this->setContent($response);
    }
}
