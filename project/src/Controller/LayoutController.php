<?php

namespace Ncanode\Controller;

use Perfumer\Framework\Controller\PlainController;
use Perfumer\Framework\Router\Http\DefaultRouterControllerHelpers;
use Symfony\Component\Translation\PluralizationRules;
use Symfony\Component\Translation\Translator;

class LayoutController extends PlainController
{
    use DefaultRouterControllerHelpers;

    protected function before()
    {
        parent::before();

        PluralizationRules::set(function ($number) {
            return (1 == $number) ? 0 : 1;
        }, 'kz');

        /** @var Translator $translator */
        $translator = $this->s('translator');
        $translator->setLocale('ru');
    }
}
