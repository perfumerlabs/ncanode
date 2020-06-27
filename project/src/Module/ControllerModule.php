<?php

namespace Ncanode\Module;

use Perfumer\Framework\Controller\Module;

class ControllerModule extends Module
{
    public $name = 'ncanode';

    public $router = 'ncanode.router';

    public $request = 'ncanode.request';

    public $components = [
        'view' => 'view.status'
    ];
}