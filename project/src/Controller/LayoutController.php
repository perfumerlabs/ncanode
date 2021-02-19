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

        $api_locale = $this->getExternalRequest()->headers->get('api-locale');

        if (!$api_locale) {
            $api_locale = 'ru';
        }

        /** @var Translator $translator */
        $translator = $this->s('translator');

        $translator->setLocale($api_locale);
    }

    protected function validateNotEmpty($var, $name)
    {
        if (!$var) {
            $this->forward('error', 'badRequest', ["\"$name\" " . $this->t('error.parameter_must_be_set')]);
        }
    }
}
