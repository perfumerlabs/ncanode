<?php

namespace Project;

use Perfumer\Framework\Gateway\CompositeGateway;

class Gateway extends CompositeGateway
{
    protected function configure(): void
    {
        $this->addModule('ncanode', 'NCANODE_HOST', null, 'http');
        $this->addModule('ncanode', 'ncanode',      null, 'cli');
    }
}
