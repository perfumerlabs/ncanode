<?php

namespace Project\Service;

use Malikzh\PhpNCANode\NCANodeClient;
use Malikzh\PhpNCANode\XMLVerificationResult;

class Ncanode extends NCANodeClient
{
    //Для кэшириования
    private $rawVerifyResult;

    //Для кэшириования
    private $x509VerifyResult;

    //Для кэшириования
    private $xmlVerifyResult;

    //Для кэшириования
    private $cmsVerifyResult;

    private $dummy;

    public function __construct($host = 'http://127.0.0.1:14579', $dummy = false, $timeout = 60)
    {
        parent::__construct($host, $timeout);

        $this->dummy = $dummy;
    }

    public function nodeInfo2()
    {
        $request = [
            'version' => '2.0',
            'method'  => 'node.info',
        ];

        return $this->request($request);
    }

    public function cmsVerify(string $cms, bool $verifyOcsp = false, bool $verifyCrl = false): ?array
    {
        $request = [
            'version' => '2.0',
            'method'  => 'cms.verify',
            'params'  => [
                'cms'       => $cms,
                'checkOcsp' => $verifyOcsp,
                'checkCrl'  => $verifyCrl,
            ],
        ];

        //Возвращаем из закешированной переменной, если такая подпись есть
        if (isset($this->cmsVerifyResult['request'], $this->cmsVerifyResult['result'])
            && $this->cmsVerifyResult['request']['params']['cms'] === $cms) {
            if (!$verifyOcsp && !$verifyCrl
                || $this->cmsVerifyResult['request']['params']['checkOcsp']
                && $this->cmsVerifyResult['request']['params']['checkCrl']) {
                return $this->cmsVerifyResult['result'];
            }

            if ($verifyOcsp && $this->cmsVerifyResult['request']['params']['checkOcsp'] && !$verifyCrl) {
                return $this->cmsVerifyResult['result'];
            }

            if ($verifyCrl && $this->cmsVerifyResult['request']['params']['checkCrl'] && !$verifyOcsp) {
                return $this->cmsVerifyResult['result'];
            }
        }

        try {
            $result = $this->request($request);

            $this->cmsVerifyResult['result'] = $result['result'];
        } catch (\Throwable $e) {
            $this->cmsVerifyResult['result'] = null;
        }

        $this->cmsVerifyResult['request'] = $request;

        return $this->cmsVerifyResult['result'];
    }

    public function cmsExtract(string $cms): ?string
    {
        $request = [
            'version' => '2.0',
            'method'  => 'cms.extract',
            'params'  => [
                'cms' => $cms,
            ],
        ];

        $result = $this->request($request);

        $originalData = $result['originalData'] ?? null;

        $decoded = $originalData ? base64_decode($originalData) : null;

        return $decoded ?: null;
    }

    /**
     * Проверяем CMS-подпись
     *
     * @param string $cms
     * @param bool   $verifyOcsp
     * @param bool   $verifyCrl
     * @return array|null
     */
    public function rawVerify(string $cms, bool $verifyOcsp = false, bool $verifyCrl = false): ?array
    {
        $request = [
            'version' => '1.0',
            'method'  => 'RAW.verify',
            'params'  => [
                'cms'        => $cms,
                'verifyOcsp' => $verifyOcsp,
                'verifyCrl'  => $verifyCrl,
            ],
        ];

        //Возвращаем из закешированной переменной, если такая подпись есть
        if (isset($this->rawVerifyResult['request'], $this->rawVerifyResult['result'])
            && $this->rawVerifyResult['request']['params']['cms'] === $cms) {
            if (!$verifyOcsp && !$verifyCrl
                || $this->rawVerifyResult['request']['params']['verifyOcsp']
                && $this->rawVerifyResult['request']['params']['verifyCrl']) {
                return $this->rawVerifyResult['result'];
            }

            if ($verifyOcsp && $this->rawVerifyResult['request']['params']['verifyOcsp'] && !$verifyCrl) {
                return $this->rawVerifyResult['result'];
            }

            if ($verifyCrl && $this->rawVerifyResult['request']['params']['verifyCrl'] && !$verifyOcsp) {
                return $this->rawVerifyResult['result'];
            }
        }

        try {
            $result = $this->request($request);

            $this->rawVerifyResult['result'] = $result['result'];
        } catch (\Throwable $e) {
            $this->rawVerifyResult['result'] = null;
        }

        $this->rawVerifyResult['request'] = $request;

        return $this->rawVerifyResult['result'];
    }

    /**
     * Проверяем CMS-подпись
     *
     * @param string $cms
     * @param bool   $verifyOcsp
     * @param bool   $verifyCrl
     * @return array|null
     */
    public function x509Verify(string $cms, bool $verifyOcsp = false, bool $verifyCrl = false): ?array
    {
        $request = [
            'version' => '1.0',
            'method'  => 'X509.info',
            'params'  => [
                'cert'       => $cms,
                'verifyOcsp' => $verifyOcsp,
                'verifyCrl'  => $verifyCrl,
            ],
        ];

        //Возвращаем из закешированной переменной, если такая подпись есть
        if (
            isset($this->x509VerifyResult['request'], $this->x509VerifyResult['result'])
            && isset($this->x509VerifyResult['request']['params'])
            && isset($this->x509VerifyResult['request']['params']['cms'])
            && $this->x509VerifyResult['request']['params']['cms'] === $cms
        ) {
            if (!$verifyOcsp && !$verifyCrl
                || $this->x509VerifyResult['request']['params']['verifyOcsp']
                && $this->x509VerifyResult['request']['params']['verifyCrl']) {
                return $this->x509VerifyResult['result'];
            }

            if ($verifyOcsp && $this->x509VerifyResult['request']['params']['verifyOcsp'] && !$verifyCrl) {
                return $this->x509VerifyResult['result'];
            }

            if ($verifyCrl && $this->x509VerifyResult['request']['params']['verifyCrl'] && !$verifyOcsp) {
                return $this->x509VerifyResult['result'];
            }
        }

        try {
            $result = $this->request($request);

            $this->x509VerifyResult['result'] = $result['result'];
        } catch (\Throwable $e) {
            $this->x509VerifyResult['result'] = null;
        }

        $this->x509VerifyResult['request'] = $request;

        return $this->x509VerifyResult['result'];
    }

    /**
     * @param string $xml
     * @param false  $verifyOcsp
     * @param false  $verifyCrl
     * @return XMLVerificationResult|mixed
     */
    public function xmlVerify($xml, $verifyOcsp = false, $verifyCrl = false)
    {
        if (isset($this->xmlVerifyResult['params'], $this->xmlVerifyResult['result'])
            && $this->xmlVerifyResult['params']['xml'] === $xml) {
            if (!$verifyOcsp && !$verifyCrl
                || $this->xmlVerifyResult['params']['verifyOcsp']
                && $this->xmlVerifyResult['params']['verifyCrl']) {
                return $this->xmlVerifyResult['result'];
            }

            if ($verifyOcsp && $this->xmlVerifyResult['params']['verifyOcsp'] && !$verifyCrl) {
                return $this->xmlVerifyResult['result'];
            }

            if ($verifyCrl && $this->xmlVerifyResult['params']['verifyCrl'] && !$verifyOcsp) {
                return $this->xmlVerifyResult['result'];
            }
        }

        try {
            $this->xmlVerifyResult = [
                'result' => parent::xmlVerify($xml, $verifyOcsp, $verifyCrl)->getRaw(),
                'params' => [
                    'xml'        => $xml,
                    'verifyOcsp' => $verifyOcsp,
                    'verifyCrl'  => $verifyCrl,
                ],
            ];
        } catch (\Throwable $e) {
            $this->xmlVerifyResult = [
                'result' => null,
                'params' => [
                    'xml'        => $xml,
                    'verifyOcsp' => $verifyOcsp,
                    'verifyCrl'  => $verifyCrl,
                ],
            ];
        }

        return $this->xmlVerifyResult['result'];
    }
}