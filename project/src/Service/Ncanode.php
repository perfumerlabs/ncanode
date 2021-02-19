<?php

namespace Project\Service;

use Malikzh\PhpNCANode\CertificateInfo;
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

    /**
     * Проверяем валиден ли сертификат по подписи
     *
     * @param string $cms
     * @param bool   $verifyOcsp
     * @param bool   $verifyCrl
     * @param bool   $checkChain
     * @return bool
     */
    public function isCertificateLegal(
        string $cms,
        bool $verifyOcsp = false,
        bool $verifyCrl = false,
        bool $checkChain = true
    ): bool {
        if ($this->dummy) {
            return true;
        }

        $rawVerifyResult = $this->rawVerify($cms, $verifyOcsp, $verifyCrl);

        if (!isset($rawVerifyResult['cert'])) {
            return false;
        }

        $certificateInfo = new CertificateInfo($rawVerifyResult['cert']);

        return $certificateInfo->isLegal($checkChain);
    }

    /**
     * Проверяем валиден ли сертификат по XML подписи
     *
     * @param string $xml
     * @param bool   $verifyOcsp
     * @param bool   $verifyCrl
     * @param bool   $checkChain
     * @return bool
     */
    public function isXmlCertificateLegal(
        string $xml,
        bool $verifyOcsp = false,
        bool $verifyCrl = false,
        bool $checkChain = true
    ): bool {
        if ($this->dummy) {
            return true;
        }

        $xmlVerifyResult = $this->xmlVerify($xml, $verifyOcsp, $verifyCrl);

        if (!$xmlVerifyResult) {
            return false;
        }

        $certificateInfo = new CertificateInfo($xmlVerifyResult['cert']);

        return $certificateInfo->isLegal($checkChain);
    }

    public function isAuthCertificate(string $cms, bool $verifyOcsp = false, bool $verifyCrl = false): bool
    {
        if ($this->dummy) {
            return true;
        }

        $rawVerifyResult = $this->x509Verify($cms, $verifyOcsp, $verifyCrl);

        if (!$rawVerifyResult) {
            return false;
        }

        $certificateInfo = new CertificateInfo($rawVerifyResult);

        if ($certificateInfo->__get('keyUsage') !== 'AUTH') {
            return false;
        }

        return true;
    }

    /**
     * Проверяем валиден ли сертификат по подписи
     *
     * @param string $cms
     * @param bool   $verifyOcsp
     * @param bool   $verifyCrl
     * @param bool   $checkChain
     * @return bool
     */
    public function isAuthCertificateLegal(
        string $cms,
        bool $verifyOcsp = false,
        bool $verifyCrl = false,
        bool $checkChain = true
    ): bool {
        if ($this->dummy) {
            return true;
        }

        $rawVerifyResult = $this->x509Verify($cms, $verifyOcsp, $verifyCrl);

        if (!$rawVerifyResult) {
            return false;
        }

        $certificateInfo = new CertificateInfo($rawVerifyResult);

        return $certificateInfo->isLegal($checkChain);
    }

    /**
     * Проверяем не окончился ли срок действия сертификата по подписи
     *
     * @param string $cms
     * @param bool   $verifyOcsp
     * @param bool   $verifyCrl
     * @param null   $date
     * @return bool
     */
    public function isCertificateNotExpired(
        string $cms,
        bool $verifyOcsp = false,
        bool $verifyCrl = false,
        $date = null
    ): bool {
        if ($this->dummy) {
            return true;
        }

        $rawVerifyResult = $this->rawVerify($cms, $verifyOcsp, $verifyCrl);

        if (!isset($rawVerifyResult['cert'])) {
            return false;
        }

        $certificateInfo = new CertificateInfo($rawVerifyResult['cert']);

        return !$certificateInfo->isExpired($date);
    }

    /**
     * Проверяем не окончился ли срок действия сертификата по XML подписи
     *
     * @param string $xml
     * @param bool   $verifyOcsp
     * @param bool   $verifyCrl
     * @param null   $date
     * @return bool
     */
    public function isXmlCertificateNotExpired(
        string $xml,
        bool $verifyOcsp = false,
        bool $verifyCrl = false,
        $date = null
    ): bool {
        if ($this->dummy) {
            return true;
        }

        $xmlVerifyResult = $this->xmlVerify($xml, $verifyOcsp, $verifyCrl);

        if (!isset($xmlVerifyResult['cert'])) {
            return false;
        }

        $certificateInfo = new CertificateInfo($xmlVerifyResult['cert']);

        return !$certificateInfo->isExpired($date);
    }

    /**
     * Проверяем не окончился ли срок действия сертификата по подписи
     *
     * @param string $cms
     * @param bool   $verifyOcsp
     * @param bool   $verifyCrl
     * @param null   $date
     * @return bool
     */
    public function isAuthCertificateNotExpired(
        string $cms,
        bool $verifyOcsp = false,
        bool $verifyCrl = false,
        $date = null
    ): bool {
        if ($this->dummy) {
            return true;
        }

        $rawVerifyResult = $this->x509Verify($cms, $verifyOcsp, $verifyCrl);

        if (!$rawVerifyResult) {
            return false;
        }

        $certificateInfo = new CertificateInfo($rawVerifyResult);

        return !$certificateInfo->isExpired($date);
    }

    /**
     * Получаем ИИН по подписи
     *
     * @param string|null $cms
     * @param bool        $verifyOcsp
     * @param bool        $verifyCrl
     * @return string|null
     */
    public function getIin(?string $cms, bool $verifyOcsp = false, bool $verifyCrl = false): ?string
    {
        if (!$cms) {
            return null;
        }

        $rawVerifyResult = $this->rawVerify($cms, $verifyOcsp, $verifyCrl);

        if (!isset($rawVerifyResult['cert'])) {
            return null;
        }

        $certificateInfo = new CertificateInfo($rawVerifyResult['cert']);

        $subject = $certificateInfo->__get('subject');

        return $subject['iin'] ?? null;
    }

    /**
     * Получаем ИИН по подписи AUTH
     *
     * @param string|null $cms
     * @param bool        $verifyOcsp
     * @param bool        $verifyCrl
     * @return string|null
     */
    public function getIinFromX509(?string $cms, bool $verifyOcsp = false, bool $verifyCrl = false): ?string
    {
        if (!$cms) {
            return null;
        }

        $rawVerifyResult = $this->x509Verify($cms, $verifyOcsp, $verifyCrl);

        if (!$rawVerifyResult) {
            return null;
        }

        $certificateInfo = new CertificateInfo($rawVerifyResult);

        $subject = $certificateInfo->__get('subject');

        return $subject['iin'] ?? null;
    }

    /**
     * получаем данные субъекта по подписи
     *
     * @param string|null $cms
     * @param bool        $verifyOcsp
     * @param bool        $verifyCrl
     * @return array|null
     */
    public function getSubject(?string $cms, bool $verifyOcsp = false, bool $verifyCrl = false): ?array
    {
        if (!$cms) {
            return null;
        }

        $rawVerifyResult = $this->rawVerify($cms, $verifyOcsp, $verifyCrl);

        if (!isset($rawVerifyResult['cert'])) {
            return null;
        }

        $certificateInfo = new CertificateInfo($rawVerifyResult['cert']);

        return $certificateInfo->__get('subject');
    }

    /**
     * получаем данные субъекта по подписи
     *
     * @param string|null $cms
     * @param bool        $verifyOcsp
     * @param bool        $verifyCrl
     * @return array|null
     */
    public function getSubjectFromX509(?string $cms, bool $verifyOcsp = false, bool $verifyCrl = false): ?array
    {
        if (!$cms) {
            return null;
        }

        $rawVerifyResult = $this->x509Verify($cms, $verifyOcsp, $verifyCrl);

        if (!$rawVerifyResult) {
            return null;
        }

        $certificateInfo = new CertificateInfo($rawVerifyResult);

        return $certificateInfo->__get('subject');
    }

    /**
     * Получаем ИИН по XML подписи
     *
     * @param string|null $xml
     * @param bool        $verifyOcsp
     * @param false       $verifyCrl
     * @return mixed|null
     */
    public function getIinByXml(?string $xml, bool $verifyOcsp = false, $verifyCrl = false)
    {
        if (!$xml) {
            return null;
        }

        $xmlVerifyResult = $this->xmlVerify($xml, $verifyOcsp, $verifyCrl);

        if (!isset($xmlVerifyResult['cert'])) {
            return null;
        }

        $certificateInfo = new CertificateInfo($xmlVerifyResult['cert']);

        $subject = $certificateInfo->__get('subject');

        return $subject['iin'] ?? null;
    }

    /**
     * Получаем БИН по подписи
     *
     * @param string|null $cms
     * @param bool        $verifyOcsp
     * @param bool        $verifyCrl
     * @return string|null
     */
    public function getBin(?string $cms, bool $verifyOcsp = false, bool $verifyCrl = false): ?string
    {
        if (!$cms) {
            return null;
        }

        $rawVerifyResult = $this->rawVerify($cms, $verifyOcsp, $verifyCrl);

        if (!isset($rawVerifyResult['cert'])) {
            return null;
        }

        $certificateInfo = new CertificateInfo($rawVerifyResult['cert']);

        $subject = $certificateInfo->__get('subject');

        return $subject['bin'] ?? null;
    }

    /**
     * Получаем БИН по подписи
     *
     * @param string|null $cms
     * @param bool        $verifyOcsp
     * @param bool        $verifyCrl
     * @return string|null
     */
    public function getBinByX509(?string $cms, bool $verifyOcsp = false, bool $verifyCrl = false): ?string
    {
        if (!$cms) {
            return null;
        }

        $rawVerifyResult = $this->x509Verify($cms, $verifyOcsp, $verifyCrl);

        if (!isset($rawVerifyResult)) {
            return null;
        }

        $certificateInfo = new CertificateInfo($rawVerifyResult);

        $subject = $certificateInfo->__get('subject');

        return $subject['bin'] ?? null;
    }

    /**
     * Получаем БИН по XML подписи
     *
     * @param string|null $xml
     * @param bool        $verifyOcsp
     * @param bool        $verifyCrl
     * @return string|null
     */
    public function getBinByXml(?string $xml, bool $verifyOcsp = false, bool $verifyCrl = false): ?string
    {
        if (!$xml) {
            return null;
        }

        $xmlVerifyResult = $this->xmlVerify($xml, $verifyOcsp, $verifyCrl);

        if (!isset($xmlVerifyResult['cert'])) {
            return null;
        }

        $certificateInfo = new CertificateInfo($xmlVerifyResult['cert']);

        $subject = $certificateInfo->__get('subject');

        return $subject['bin'] ?? null;
    }

    public function isEmployee(string $cms, bool $verifyOcsp = false, bool $verifyCrl = false): bool
    {
        $rawVerifyResult = $this->rawVerify($cms, $verifyOcsp, $verifyCrl);

        if (!isset($rawVerifyResult['cert'])) {
            return false;
        }

        $certificateInfo = new CertificateInfo($rawVerifyResult['cert']);

        $keyUser = $certificateInfo->__get('keyUser');

        if (in_array('EMPLOYEE', $keyUser, true)) {
            return true;
        }

        return false;
    }

    public function isEmployeeByXml(string $xml, bool $verifyOcsp = false, bool $verifyCrl = false): bool
    {
        $xmlVerifyResult = $this->xmlVerify($xml, $verifyOcsp, $verifyCrl);

        if (!isset($xmlVerifyResult['cert'])) {
            return false;
        }

        $certificateInfo = new CertificateInfo($xmlVerifyResult['cert']);

        $keyUser = $certificateInfo->__get('keyUser');

        if (in_array('EMPLOYEE', $keyUser, true)) {
            return true;
        }

        return false;
    }

    public function isIndividual(string $cms, bool $verifyOcsp = false, bool $verifyCrl = false): bool
    {
        if (!$cms) {
            return false;
        }

        $rawVerifyResult = $this->x509Verify($cms, $verifyOcsp, $verifyCrl);

        if (!$rawVerifyResult) {
            return false;
        }

        $certificateInfo = new CertificateInfo($rawVerifyResult);

        $keyUser = $certificateInfo->__get('keyUser');

        if (in_array('INDIVIDUAL', $keyUser, true)) {
            return true;
        }

        return false;
    }

    public function isIndividualByXml(string $xml, bool $verifyOcsp = false, bool $verifyCrl = false): bool
    {
        if (!$xml) {
            return false;
        }

        $xmlVerifyResult = $this->xmlVerify($xml, $verifyOcsp, $verifyCrl);

        if (!isset($xmlVerifyResult['cert'])) {
            return false;
        }

        $certificateInfo = new CertificateInfo($xmlVerifyResult['cert']);

        $keyUser = $certificateInfo->__get('keyUser');

        if (in_array('INDIVIDUAL', $keyUser, true)) {
            return true;
        }

        return false;
    }

    public function isOrganization(string $cms, bool $verifyOcsp = false, bool $verifyCrl = false): bool
    {
        if (!$cms) {
            return false;
        }

        $rawVerifyResult = $this->x509Verify($cms, $verifyOcsp, $verifyCrl);

        if (!$rawVerifyResult) {
            return false;
        }

        $certificateInfo = new CertificateInfo($rawVerifyResult);

        $keyUser = $certificateInfo->__get('keyUser');

        if (in_array('ORGANIZATION', $keyUser, true)) {
            return true;
        }

        return false;
    }

    public function isOrganizationByXml(string $xml, bool $verifyOcsp = false, bool $verifyCrl = false): bool
    {
        if (!$xml) {
            return false;
        }

        $xmlVerifyResult = $this->xmlVerify($xml, $verifyOcsp, $verifyCrl);

        if (!isset($xmlVerifyResult['cert'])) {
            return false;
        }

        $certificateInfo = new CertificateInfo($xmlVerifyResult['cert']);

        $keyUser = $certificateInfo->__get('keyUser');

        if (in_array('ORGANIZATION', $keyUser, true)) {
            return true;
        }

        return false;
    }

    public function isCeo(string $cms, bool $verifyOcsp = false, bool $verifyCrl = false): bool
    {
        $rawVerifyResult = $this->rawVerify($cms, $verifyOcsp, $verifyCrl);

        if (!isset($rawVerifyResult['cert'])) {
            return false;
        }

        $certificateInfo = new CertificateInfo($rawVerifyResult['cert']);

        $keyUser = $certificateInfo->__get('keyUser');

        if (in_array('CEO', $keyUser, true)) {
            return true;
        }

        return false;
    }

    public function isCeoByXml(string $xml, bool $verifyOcsp = false, bool $verifyCrl = false): bool
    {
        $xmlVerifyResult = $this->xmlVerify($xml, $verifyOcsp, $verifyCrl);

        if (!isset($xmlVerifyResult['cert'])) {
            return false;
        }

        $certificateInfo = new CertificateInfo($xmlVerifyResult['cert']);

        $keyUser = $certificateInfo->__get('keyUser');

        if (in_array('CEO', $keyUser, true)) {
            return true;
        }

        return false;
    }

    public function doRequest(array $request)
    {
        return $this->request($request);
    }
}