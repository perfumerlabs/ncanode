<?php

namespace Ncanode\Controller;

use Project\Service\Ncanode;

class OriginController extends LayoutController
{
    public function post()
    {
        $method  = $this->f('method');
        $version = $this->f('version', '1.0');
        $params  = $this->f('params');

        if (!$method) {
            $this->validateNotEmpty($method, 'method');
        }

        $key = $this->getContainer()->getParam('ncanode/key');
        $pwd = $this->getContainer()->getParam('ncanode/pwd');

        if ($key && $pwd) {
            $key = file_get_contents($key);

            if (!$key) {
                $this->forward('error', 'badRequest', [$this->t('error.no_key_found')]);
            }

            $key = base64_encode($key);

            $params['p12']      = $key;
            $params['password'] = $pwd;
        }

        $request = [
            'method'  => $method,
            'version' => $version,
        ];

        if ($params) {
            $request['params'] = $params;
        }

        /** @var Ncanode $ncanode */
        $ncanode = $this->s('ncanode');

        try {
            $response = $ncanode->doRequest($request);
            $this->setContent(['origin' => $response]);
        } catch (\Throwable $e) {
            $this->forward('error', 'internalServerError', [$e]);
        }
    }
}
