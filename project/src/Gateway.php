<?php

namespace Project;

use Perfumer\Framework\Gateway\CompositeGateway;

class Gateway extends CompositeGateway
{
    protected function configure(): void
    {
        $this->addModule('ncanode', 'ncanode.local',      null, 'http');
//        $this->addModule('ncanode', null,      null, 'http');
        $this->addModule('ncanode', 'ncanode', null, 'cli');
    }
}
