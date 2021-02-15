<?php

namespace Ncanode\Controller;

use Project\Service\Ncanode;

class NodeInfoController extends LayoutController
{
    public function get()
    {
        /** @var Ncanode $ncanode */
        $ncanode = $this->s('ncanode');

        $response = $ncanode->nodeInfo2();

        $this->setContent($response);
    }
}
