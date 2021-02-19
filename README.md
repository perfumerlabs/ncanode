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
    "validate": {
      "result": true
    }
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
- version [string,optional] - ncanode api version. Default '1.0'
- params [array,optional] - array of params
</p>

<p>

Success response:
```json
{
  "status": true,
  "message": null,
  "content": {
    "origin": {
      "result": {
        "xml": "<?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"no\"?><root><name>NCANode</name><ds:Signature xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\">\r\n<ds:SignedInfo>\r\n<ds:CanonicalizationMethod Algorithm=\"http://www.w3.org/TR/2001/REC-xml-c14n-20010315\"/>\r\n<ds:SignatureMethod Algorithm=\"http://www.w3.org/2001/04/xmldsig-more#rsa-sha256\"/>\r\n<ds:Reference URI=\"\">\r\n<ds:Transforms>\r\n<ds:Transform Algorithm=\"http://www.w3.org/2000/09/xmldsig#enveloped-signature\"/>\r\n<ds:Transform Algorithm=\"http://www.w3.org/TR/2001/REC-xml-c14n-20010315#WithComments\"/>\r\n</ds:Transforms>\r\n<ds:DigestMethod Algorithm=\"http://www.w3.org/2001/04/xmlenc#sha256\"/>\r\n<ds:DigestValue>ybvg7uzrmIoa6Q02yU8BiLjYNl64fr+yXCtg0kHwdv4=</ds:DigestValue>\r\n</ds:Reference>\r\n</ds:SignedInfo>\r\n<ds:SignatureValue>\r\niSO1UrZLWBsiMAybQEkgvz7VgGjfmixA==\r\n</ds:SignatureValue>\r\n<ds:KeyInfo>\r\n<ds:X509Data>\r\n<ds:X509Certificate>\r\nLCt2q\r\n</ds:X509Certificate>\r\n</ds:X509Data>\r\n</ds:KeyInfo>\r\n</ds:Signature></root>"
      }
    }
  }
}
```
</p>
</details>

<details>
<summary><code>GET /signature</code> - get signature</summary>
<p>

Parameters (json). Provide id, parent or (document, chain, stage):
- id [integer,optional] - ID of signature
- parent [integer,optional] - Parent ID of signature
- document [string,optional] - Sign document
- chain [string,optional] - Chain of signature
- stage [string,optional] - Stage of signature
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
      "document": "doc_12",
      "chain": "ticket_42",
      "stage": "stage_1",
      "signature": "MIIIrwYJKoZIhvcNAQcCoIIIoDCCCx+EWy11vQtlLdPQ==",
      "parent": null,
      "tags": [
        "customer_1",
        "process_1"
      ],
      "created_at": "2021-02-18 15:00:00",
      "updated_at": "2021-02-18 15:00:00"
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
- document [string,required] - sign document
- chain [string,optional] - chain of signature
- stage [string,optional] - stage of signature
- signature [string, required] - CMS or XML of signed data
- parent [int,optional] - ID of parent signature
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
      "document": "doc_12",
      "chain": "ticket_42",
      "stage": "stage_1",
      "signature": "MIIIrwYJKoZIhvcNAQcCoIIIoDCCCx+EWy11vQtlLdPQ==",
      "parent": null,
      "tags": [
        "customer_1",
        "process_1"
      ],
      "created_at": "2021-02-18 15:00:00",
      "updated_at": "2021-02-18 15:00:00"
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
- document [string,optional] - sign document
- chain [string,optional] - chain of signature
- stage [string,optional] - stage of signature
- tags [array,optional] - array of tags
- limit [integer,optional] - limit of fetching data
- offset [integer,optional] - offset of fetching data
- count [bool,optional] - show total count?
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
        "document": "doc_12",
        "chain": "ticket_42",
        "stage": "stage_1",
        "signature": "MIIIrwYJKoZIhvcNAQcCoIIIoDCCCx+EWy11vQtlLdPQ==",
        "parent": null,
        "tags": [
          "customer_1",
          "process_1"
        ],
        "created_at": "2021-02-18 15:00:00",
        "updated_at": "2021-02-18 15:00:00"
      },
      {
        "id": 1,
        "document": "doc_12",
        "chain": "ticket_42",
        "stage": "stage_1",
        "signature": "MIIIrwYJKoZIhvcNAQcCoIIIoDCCCx+EWy11vQtlLdPQ==",
        "parent": null,
        "tags": [
          "customer_1",
          "process_1"
        ],
        "created_at": "2021-02-18 15:00:00",
        "updated_at": "2021-02-18 15:00:00"
      }
    ]
  }
}

```
</p>
</details>