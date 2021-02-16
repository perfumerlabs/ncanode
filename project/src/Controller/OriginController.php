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

        $NCANODE_KEY = $this->getContainer()->getParam('ncanode/key');
        $pwd         = $this->getContainer()->getParam('ncanode/pwd');

        /** @var Ncanode $ncanode */
        $ncanode = $this->s('ncanode');

        $key = file_get_contents($NCANODE_KEY);

        if (!$key) {
            $this->forward('error', 'badRequest', ['No key found']);
        }

        $key = base64_encode($key);

        $params['p12']      = $key;
        $params['password'] = $pwd;

        $request = [
            'method'  => $method,
            'version' => $version,
            'params'  => $params,
        ];

        try {
            $response = $ncanode->doRequest($request);
            $this->setContent($response);
        } catch (\Throwable $e) {
            $this->forward('error', 'internalServerError', [$e]);
        }
    }
}
