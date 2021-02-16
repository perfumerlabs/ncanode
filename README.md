What is it
==========

This is an image to proxy requests to [Ncanode](https://ncanode.kz/) server.
The purpose is to hide private key and key password.
API is the same as at original project.
Only "xml.sign" request is supported for now.
Parameters "p12" and "password" this container will set by itself. 

Installation
============

```bash
docker run \
-p 80:80/tcp \
-e NCANODE_REMOTE_URL=http://127.0.0.1:14579 \
-e NCANODE_KEY=/path/to/key \
-e NCANODE_PWD=123456 \
-d perfumerlabs/ncanode:v2.0.0
```

Environment variables
=====================

- NCANODE_REMOTE_URL - full url to original ncanode server. Required.
- NCANODE_KEY - path to private key on the container. Required.
- NCANODE_PWD - password of the private key. Required.

Volumes
=======

This image has no volumes.

If you want to make any additional configuration of container, mount your bash script to /opt/setup.sh. This script will be executed on container setup.

Software
========

1. Ubuntu 16.04 Xenial
1. Nginx 1.16
1. PHP 7.4

API REFERENCE
=============

<details>
<summary><code>POST /validate</code> - validate CMS or XML sign by rule parameter</summary>
<p>

Parameters (json):
- cms [string,optional] - CMS-sign in Base64 format
- xml [string,optional] - XML-sign
- iin [string,optional] - IIN
- bin [string,optional] - BIN
- rule [string,required] - Rule for validating. One of ['iin', 'bin', 'auth', 'individual', 'employee', 'ceo', 'organisation']
</p>
<p>

Success response:
```json
{
  "status": true,
  "message": null,
  "content": {
    "result": true
  }
}
```
</p>
</details>

<details>
<summary><code>POST /origin</code> - ncanode origin request</summary>
<p>

Parameters (json):
- method [string,required] - Method. Ex. 'XML.sign'
- version [string, optional] - ncanode api version. Default '1.0'
- params [array, optional] - array of params
</p>

<p>

Success response:
```json
{
  "status": true,
  "message": null,
  "content": {
    "result": {
      "xml": "<?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"no\"?><root><name>NCANode</name><ds:Signature xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\">\r\n<ds:SignedInfo>\r\n<ds:CanonicalizationMethod Algorithm=\"http://www.w3.org/TR/2001/REC-xml-c14n-20010315\"/>\r\n<ds:SignatureMethod Algorithm=\"http://www.w3.org/2001/04/xmldsig-more#rsa-sha256\"/>\r\n<ds:Reference URI=\"\">\r\n<ds:Transforms>\r\n<ds:Transform Algorithm=\"http://www.w3.org/2000/09/xmldsig#enveloped-signature\"/>\r\n<ds:Transform Algorithm=\"http://www.w3.org/TR/2001/REC-xml-c14n-20010315#WithComments\"/>\r\n</ds:Transforms>\r\n<ds:DigestMethod Algorithm=\"http://www.w3.org/2001/04/xmlenc#sha256\"/>\r\n<ds:DigestValue>ybvg7uzrmIoa6Q02yU8BiLjYNl64fr+yXCtg0kHwdv4=</ds:DigestValue>\r\n</ds:Reference>\r\n</ds:SignedInfo>\r\n<ds:SignatureValue>\r\niAo6o5tfMBmXAxOxNTPVZGgjBebA9+taJyywl+h8e992FJYOBr84w92RSk9gwG+VAZXrHaSVsIo5\r\ngirvJVwNfDwIyX0to2z5d2/XRa780uNMHTR3oF5RQ97miZqDemBu7PVwG1ayEOMIrmdbnl8+Qr8G\r\n19I/CaSmViifwt/XGBalIZxIdFNjT6v0NIPizDLlJcHL8tNe73Sjj4f5Ux11oYQ/Ml8l7UhVtYOw\r\nsz/rWIwXqAYocXilUno0CwVKTR26JfIJELyBmrn+9aKXDdusrGfc+T+2ADKVd/52G656Pe2fDghd\r\nKfSRBfpSO1UrZLWBsiMAybQEkgvz7VgGjfmixA==\r\n</ds:SignatureValue>\r\n<ds:KeyInfo>\r\n<ds:X509Data>\r\n<ds:X509Certificate>\r\nMIIGZTCCBE2gAwIBAgIUFX1cSXpU/SdXs4r74PS8YFuVbAowDQYJKoZIhvcNAQELBQAwUjELMAkG\r\nA1UEBhMCS1oxQzBBBgNVBAMMOtKw0JvQotCi0KvSmiDQmtCj05jQm9CQ0J3QlNCr0KDQo9Co0Ksg\r\n0J7QoNCi0JDQm9Cr0pogKFJTQSkwHhcNMTgwODIyMTIxMTM2WhcNMTkwODIyMTIxMTM2WjCBpzEe\r\nMBwGA1UEAwwV0KLQldCh0KLQntCSINCi0JXQodCiMRUwEwYDVQQEDAzQotCV0KHQotCe0JIxGDAW\r\nBgNVBAUTD0lJTjEyMzQ1Njc4OTAxMTELMAkGA1UEBhMCS1oxFTATBgNVBAcMDNCQ0JvQnNCQ0KLQ\r\nqzEVMBMGA1UECAwM0JDQm9Cc0JDQotCrMRkwFwYDVQQqDBDQotCV0KHQotCe0JLQmNCnMIIBIjAN\r\nBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtKWLOJf9qCqA6EO/SVtiMuPZ8q3Sg2RjO0dWXqKQ\r\nRP7BWhIyMucMv+WmpRs8RuJ987Hm3B/JszSdiPrmtA9BpIERKphRwp3n4QR6pfLUBEp+5QNetNsv\r\n+dbiPcefWCzgJZCqEZVbPvSkiFH20y13YQ2FhEBUp4lLOqydBD2CsDVoTusvLanEgR+AdziJPq2+\r\niXwhttpNPShKRTXGbGkxUa4P7YMUCUqWstR7svLaJqxKDMhaR7MpEt56a2pfntm5oFxKNFoBQjRX\r\nKbiBNIKciMRAeznjezv9ZA98WzWPIMuWzi38fPW5X7IVqa7ZbAFWvZIHWJmrl57uKGBNd9EUewID\r\nAQABo4IB2zCCAdcwDgYDVR0PAQH/BAQDAgWgMB0GA1UdJQQWMBQGCCsGAQUFBwMCBggqgw4DAwQB\r\nATAPBgNVHSMECDAGgARbanQRMB0GA1UdDgQWBBRrNhuGTGeWAbZS/jh/YfzZMDwDJzBeBgNVHSAE\r\nVzBVMFMGByqDDgMDAgQwSDAhBggrBgEFBQcCARYVaHR0cDovL3BraS5nb3Yua3ovY3BzMCMGCCsG\r\nAQUFBwICMBcMFWh0dHA6Ly9wa2kuZ292Lmt6L2NwczBWBgNVHR8ETzBNMEugSaBHhiFodHRwOi8v\r\nY3JsLnBraS5nb3Yua3ovbmNhX3JzYS5jcmyGImh0dHA6Ly9jcmwxLnBraS5nb3Yua3ovbmNhX3Jz\r\nYS5jcmwwWgYDVR0uBFMwUTBPoE2gS4YjaHR0cDovL2NybC5wa2kuZ292Lmt6L25jYV9kX3JzYS5j\r\ncmyGJGh0dHA6Ly9jcmwxLnBraS5nb3Yua3ovbmNhX2RfcnNhLmNybDBiBggrBgEFBQcBAQRWMFQw\r\nLgYIKwYBBQUHMAKGImh0dHA6Ly9wa2kuZ292Lmt6L2NlcnQvbmNhX3JzYS5jZXIwIgYIKwYBBQUH\r\nMAGGFmh0dHA6Ly9vY3NwLnBraS5nb3Yua3owDQYJKoZIhvcNAQELBQADggIBACy0Lxj0D/q3SwUz\r\n0X9BICyKPw/U6sXmedqUcrghzZuT9ojnUp9w7g4ndZOKTRRxQyLiUYb9neJ3SGVuF/XYcs7Ovrp5\r\nRGNNHuVUR8bQz9cbWd/O2qRUY6qlg4ZSjYsjFYaQm8o+uO56PuqWG125O7XNUdAUHNBc2hUrrngG\r\nKU0FKxlBygxLpvTf4I9q3QA0PJ6MnHrUKlor4sRGar4hMJCbrxeMG4pv3Jx/r9fsKy7f+yZeQo3T\r\n4XAIXmUTXF8UC3HtIroxAP6yEoEhG76oS3qvYc1K/krI48ju5VYxmzEabNqRhiiEBpocIwCqFLLo\r\n9x3CKuUkuA7pwEib4YcCNxCTucCtd9x8dGgZRNffJV4de/Aja/VP84q8rxmcyogbUQzvPb+2/zKR\r\nh6cxYxnRsuL4wWUV+fxp/usy0mJMboQF7IcRFe1fXosU0RWYmKHITOCDbs0NKxTn7TSxEKMYdJN6\r\nYngCmKlmwR/+AfxhN1QMSQpU/m8Glwl+f5wZIL5MQJVhrrWIteh0tnb+OuDQHz4g2vmD2xq5jUQD\r\nFIrjXOdy4zToqM6tirt3nGDsblWgcgsPac50FLT1+um7W26UsmtZ9/wXvkxYC9kL5gUX53VD/bcK\r\nki8fogjrNoYEZiORRqmwvZ5EVe4w3Hfb7YCnc3NzhhIg6hqmzumXNCgLCt2q\r\n</ds:X509Certificate>\r\n</ds:X509Data>\r\n</ds:KeyInfo>\r\n</ds:Signature></root>"
    }
  }
}
```
</p>
</details>

<details>
<summary><code>GET /signature</code> - get signature</summary>
<p>

Parameters (json):
- code [string,required] - code of signature
</p>

<p>

Success response:
```json
{
  "status": true,
  "message": null,
  "content": {
    "signature": {
      "id": 1,
      "code": "ticket_12",
      "signature": "MIIIrwYJKoZIhvcNAQcCoIIIoDCCCx+EWy11vQtlLdPQ==",
      "parent_id": null,
      "created_at": ""
    }
  }
}
```
</p>
</details>

<details>
<summary><code>POST /signature</code> - save signature</summary>
<p>

Parameters (json):
- code [string,required] - code of signature
- signature [string, required] - CMS or XML of signed data
- parent [string,optional] - code of parent signature
- tags [array, optional] - array of tags
</p>

<p>

Success response:
```json
{
  "status": true,
  "message": null,
  "content": {
    "signature": {
      "id": 2,
      "code": "ticket_13",
      "signature": "MIIIrwYJKoZIhvcNAQcCoIIIoDCCCx+EWy11vQtlLdPQ==",
      "parent_id": null,
      "created_at": ""
    }
  }
}
```
</p>
</details>

<details>
<summary><code>GET /signatures</code> - get signatures</summary>
<p>

Parameters (json):
- parent [string,optional] - code of parent signature
- tags [array, optional] - array of tags
- limit [integer, optional] - limit of fetching data
- offset [integer, optional] - offset of fetching data
</p>

<p>

Success response:
```json
{
  "status": true,
  "message": null,
  "content": {
    "signatures": [
      {
        "id": 2,
        "code": "ticket_13",
        "signature": "MIIIrwYJKoZIhvcNAQcCoIIIoDCCCx+EWy11vQtlLdPQ==",
        "parent_id": null,
        "created_at": ""
      },
      {
        "id": 1,
        "code": "ticket_12",
        "signature": "MIIIrwYJKoZIhvcNAQcCoIIIoDCCCx+EWy11vQtlLdPQ==",
        "parent_id": null,
        "created_at": ""
      }
    ]
  }
}

```
</p>
</details>