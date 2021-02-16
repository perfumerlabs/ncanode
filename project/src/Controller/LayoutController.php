<?php

namespace Ncanode\Controller;

use Perfumer\Framework\Controller\ViewController;
use Perfumer\Framework\Router\Http\FastRouteRouterControllerHelpers;
use Perfumer\Framework\View\StatusViewControllerHelpers;
use Symfony\Component\Translation\Translator;

class LayoutController extends ViewController
{
    use FastRouteRouterControllerHelpers;
    use StatusViewControllerHelpers;

    protected function before()
    {
        parent::before();

        /** @var Translator $translator */
        $translator = $this->s('translator');
        $translator->setLocale('ru');
    }


    protected function validateNotEmpty($var, $name)
    {
        if (!$var) {
            $this->forward('error', 'badRequest', ["\"$name\" parameter must be set"]);
        }
    }
}
