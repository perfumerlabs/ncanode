<?php

namespace Ncanode\Controller;

use Malikzh\PhpNCANode\NCANodeClient;

class HomeController extends LayoutController
{
    public function post()
    {
        $NCANODE_REMOTE_URL = $this->getContainer()->getParam('ncanode/remote_url');
        $NCANODE_KEY = $this->getContainer()->getParam('ncanode/key');
        $pwd = $this->getContainer()->getParam('ncanode/pwd');

        $nca = new NCANodeClient($NCANODE_REMOTE_URL);

        $key = file_get_contents($NCANODE_KEY);

        if (!$key) {
            $this->forward('error', 'badRequest', ['No key found']);
        }

        $key = base64_encode($key);
        $params = $this->f('params');

        if (!is_array($params) || !isset($params['xml']) || !is_string($params['xml'])) {
            $this->forward('error', 'badRequest', ['Xml not provided or is invalid']);
        }

        $xml = $params['xml'];

        try {
            $response = $nca->xmlSign($xml, $key, $pwd);
        } catch (\Throwable $e) {
            $this->forward('error', 'internalServerError', [$e]);
        }

        $this->getResponse()->setContent(json_encode($response));
    }
}
