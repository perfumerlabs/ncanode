<?php

namespace Ncanode\Controller;

use Perfumer\Framework\Controller\ViewController;
use Perfumer\Framework\View\StatusViewControllerHelpers;

class ErrorController extends ViewController
{
    use StatusViewControllerHelpers;

    public function badRequest($message)
    {
        $this->getExternalResponse()->setStatusCode(400);

        $this->setErrorMessage($message);
    }

    public function internalServerError($e)
    {
        $this->getExternalResponse()->setStatusCode(500);

        if ($e instanceof \Throwable) {
            $this->setErrorMessage($e->getMessage());

            error_log($e->getMessage());
        } else {
            $this->setErrorMessage((string) $e);
        }
    }
}
