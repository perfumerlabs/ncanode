<?php

namespace Ncanode\Module;

use Perfumer\Framework\Controller\Module;

class CommandModule extends Module
{
    public $name = 'ncanode';

    public $router = 'router.console';

    public $request = 'ncanode.request';
}