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
<summary><code>GET /node-info</code> - get info about ncanode server</summary>
<p>

Success response:
```json
{
  "result": {
    "dateTime": "2020-07-04 14:33:25",
    "timezone": "Asia/Almaty",
    "kalkanVersion": "0.6",
    "name": "NCANode v2.0.0",
    "version": "2.0.0",
    "status": 0,
    "message": ""
  }
}
```
</p>
</details>

### RAW

<details>
<summary><code>POST /raw/verify</code> - verify CMS-sign</summary>
<p>

Parameters (json):
- cms [string,required] - CMS-sign in Base64 format
- verify_ocsp [boolean,optional] - Conduct revocation check via OCSP
- verify_crl [boolean,optional] - Conduct revocation check via CRL
</p>

<p>

Success response:
```json
{
  "result": {
    "tsp": [
      {
        "tspHashAlgorithm": "GOST34311",
        "serialNumber": "eb163160cfd916363e6252102db8cde44b60f500",
        "tsa": null,
        "genTime": "2019-04-29 16:14:28",
        "hash": "08a5e8f4b3e3b01fac5e53af166e5e3bc9ce81eb2449aa8d744cd41fff3f72b6",
        "policy": "1.2.398.3.3.2.6.1"
      }
    ],
    "cert": {
      "valid": true,
      "notAfter": "2019-08-22 18:11:36",
      "chain": [
        {
          "valid": true,
          "notAfter": "2019-08-22 18:11:36",
          "keyUsage": "AUTH",
          "serialNumber": "122684438670642568061334282296011886211357830154",
          "subject": {
            "lastName": "ТЕСТОВИЧ",
            "country": "KZ",
            "commonName": "ТЕСТОВ ТЕСТ",
            "gender": "",
            "surname": "ТЕСТОВ",
            "locality": "АЛМАТЫ",
            "dn": "CN=ТЕСТОВ ТЕСТ,SURNAME=ТЕСТОВ,SERIALNUMBER=IIN123456789011,C=KZ,L=АЛМАТЫ,S=АЛМАТЫ,G=ТЕСТОВИЧ",
            "state": "АЛМАТЫ",
            "birthDate": "12-34-56",
            "iin": "123456789011"
          },
          "signAlg": "SHA256WithRSAEncryption",
          "sign": "LLQvGPQP+rdLBTPRf0EgLIo/D9TqxeZ52pRyuCHNm5P2iOdSn3DuDid1k4pNFHFDIuJRhv2d4ndIZW4X9dhyzs6+unlEY00e5VRHxtDP1xtZ387apFRjqqWDhlKNiyMVhpCbyj647no+6pYbXbk7tc1R0BQc0FzaFSuueAYpTQUrGUHKDEum9N/gj2rdADQ8noycetQqWivixEZqviEwkJuvF4wbim/cnH+v1+wrLt/7Jl5CjdPhcAheZRNcXxQLce0iujEA/rISgSEbvqhLeq9hzUr+SsjjyO7lVjGbMRps2pGGKIQGmhwjAKoUsuj3HcIq5SS4DunASJvhhwI3EJO5wK133Hx0aBlE198lXh178CNr9U/ziryvGZzKiBtRDO89v7b/MpGHpzFjGdGy4vjBZRX5/Gn+6zLSYkxuhAXshxEV7V9eixTRFZiYochM4INuzQ0rFOftNLEQoxh0k3pieAKYqWbBH/4B/GE3VAxJClT+bwaXCX5/nBkgvkxAlWGutYi16HS2dv464NAfPiDa+YPbGrmNRAMUiuNc53LjNOiozq2Ku3ecYOxuVaByCw9pznQUtPX66btbbpSya1n3/Be+TFgL2QvmBRfndUP9twqSLx+iCOs2hgRmI5FGqbC9nkRV7jDcd9vtgKdzc3OGEiDqGqbO6Zc0KAsK3ao=",
          "publicKey": "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtKWLOJf9qCqA6EO/SVtiMuPZ8q3Sg2RjO0dWXqKQRP7BWhIyMucMv+WmpRs8RuJ987Hm3B/JszSdiPrmtA9BpIERKphRwp3n4QR6pfLUBEp+5QNetNsv+dbiPcefWCzgJZCqEZVbPvSkiFH20y13YQ2FhEBUp4lLOqydBD2CsDVoTusvLanEgR+AdziJPq2+iXwhttpNPShKRTXGbGkxUa4P7YMUCUqWstR7svLaJqxKDMhaR7MpEt56a2pfntm5oFxKNFoBQjRXKbiBNIKciMRAeznjezv9ZA98WzWPIMuWzi38fPW5X7IVqa7ZbAFWvZIHWJmrl57uKGBNd9EUewIDAQAB",
          "issuer": {
            "commonName": "ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
            "country": "KZ",
            "dn": "C=KZ,CN=ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)"
          },
          "notBefore": "2018-08-22 18:11:36",
          "keyUser": [
            "INDIVIDUAL"
          ]
        },
        {
          "valid": true,
          "notAfter": "2025-06-25 10:26:36",
          "keyUsage": "UNKNOWN",
          "serialNumber": "305229402244045643062022638026814839687773800430",
          "subject": {
            "commonName": "ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
            "country": "KZ",
            "dn": "C=KZ,CN=ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)"
          },
          "signAlg": "SHA256WithRSAEncryption",
          "sign": "Ddx8a01Z3HOMbVrvQcQZVS8yzIJRCYaEMbLYoWyDsMpoMB68jchHJ5ovGE4Qd2J/ihyzGe4+vRrtA9zKy98VrrJO+WPZoibepdj8tr4uU6WM0KiPcQTOMVLJJSEC/U0C+eWa5j6OpbRnQuQuJXZA/5eUJ5WMCZJae6vlIuVsNR7fnJgHdcYnxSXvgLHt9YkN1PZOuCHmFNI09U/isiUs004dRxe5a0AFVXwWy2v3DcL6K6Uq9ptBolaEy6mwYPXuVFRaZMyRFAL30vrIiU7k8dHGsNzY0Y2f+cwlfOtW049GIkTYmE6DV3zkNAKs0AhS1aDZq/epsV2R5c8Je33EF4E+SkcDuAK1h/xr8czx3Bi+tdoltlgqCHXT/dXX68L3ioelOTsLTfPYxVO2Itm3PGqfc3V5kyvz0Grgc9M8yNAKDuncn1qwzioy9ZgPiWNTqmm9M/KjyVTT3qoDmPsfFHkGwiEqUBWEyCSWEjDALbDiIvI2PuOx48O3coB7dfW0s2ClhfOvLrUKDMxVJJ1yJXOZb78ckfLlnllJrwCkPS7a43K6zK8ba5zi63TcAASCRpR+CPcEnChHPh4s8dCPu9oexo4/0ZdXbMDesYwylndleu2WGcFaxiSWix9Jpas50AH0qnijfDlGlVFZSPcBENrdb3M7iNgWIbzavtKG7nQ=",
          "publicKey": "MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEArlvMc9X0xktVYz/TmbbFKzkNnX5ZDqRN748xjaE5v/nbv56n0h2+UDG3NCW9uvpDojwmD0Vg5YVB11ASoyh6KmxpPy9vsXnr1UingzcEuz3X4vXElWFGGiWCidauN32fc3TqkS+CJc4PYHGVak8ifFU29MtEi4OOw7rko57Jl4HMuc+FRoQsb1Nw+e9m312i5xoLzxxpL1EVE1EObTfJ+4H4skT7me5f6zJwxUuQAojQAe7ghx2XoOKSo/aX8wHcFJydDsLPNMIqfmm6rpHTpW45X0QuEJpvwlIXa/Ovh5C4cActfPrX8s3ba8Ug0YwZvwuxLhKQIDP/fSxidMKwOVwAyJCLYV30dtwEwcSVfBCyg3/k5aWofgK2ZHnm6Z4+9sLAJGZkXXabrokr8nr0IOPnlioQMuGqYif4GFUy/VlWlanLcOSvi2sfdqDJeQ4XSOP1tazhifmBITKNwtZFv1e95i0OIH0mkGftZEax3BJ3Oi2Gk3xVxP0s5ImHgkrLztYiT2QuDC5MqyZ7NX0Q4k9dEYEBqbEAYvE1M8V7QCvqM+pBfS0MmMasgGrQsb22kYJ6MS4qQVK6IvOJT/IKqOUNT5HzFRYwqygzpHQQvHlkt8PGVcwK9m1F6WwbKecv2S2NuR+WQPI2aU2Qf3hL6Ooi0C4wH4noFbkf34+qXVUCAwEAAQ==",
          "issuer": {
            "country": "KZ",
            "commonName": "НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
            "organization": "РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»",
            "dn": "CN=НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA),O=РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»,C=KZ"
          },
          "notBefore": "2018-08-08 10:26:36",
          "keyUser": []
        },
        {
          "valid": true,
          "notAfter": "2025-07-27 11:22:53",
          "keyUsage": "UNKNOWN",
          "serialNumber": "483236974449879461588506755984708205979682368059",
          "subject": {
            "country": "KZ",
            "commonName": "НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
            "organization": "РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»",
            "dn": "CN=НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA),O=РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»,C=KZ"
          },
          "signAlg": "SHA256WithRSAEncryption",
          "sign": "WkjJgzPV7GDmpd9N38h9o8M+t/rpeJvEgReNzsT10fwKV3exmxwoiyFXAOjHf+lAVITj2kdcRUiD1Gr7vaWUCBpXeAMpKukfov31jG0q9Er0mWfs9iDaow66AwPa1zqh9kW8/xuEQVz/iI9Gl6F9q8bdEvFyb4xuD7TqFlqLIO7Z6oJlJZatIEACKFTTjd54d8+7/MJ3OVxfhe8ozMfXywQ3C7sjM9uSKzkgZZHmjpWTGljfAnjqP3ACLMEx1bxW+sKjjzrlRcML5iKDt8HJ2N/MtU7putMoMAAd5x79RPvZSV9h9fW4/qdnfwwneieh/w+KWJN+X6b9wMVWTh24CVif+NyCYqQFwr1RYkKtcBzSiRmmXh/rmPm4jmefGg6jNycbF66OcVI/HxnIH0zAZaVGM6eSLrbdiXjr9OSG2nt+qIkSsytjxCPuoLzLkJxYexZbDWcEDd9G2GpvYgIyFo8+ycJpdLJBa5wPUn8brd4rWnadmzjptt8LYWxrG8XcnJc2N78emf7MFP4LXyHypht+v+bWWO9uze0l6p4Z2JcPg3CFvEftAsKBkXCusE7nOgXq8kVTNBTmB3PfUcq3Ss3+QPwdziMsW8SLeEnO5Rcec7HAOrI2t24QY9htRREwUAGjAJQfDRrjEP+zzoazILyKPn6tGXhRcDybTrqqjRQ=",
          "publicKey": "MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAlqLdP8Z8G8sr5fWi+lp8r2fqRe2NLsiuHntkNTqu11bnY7h+q5LlAbTVJiPfFRchqegg64shKdqNy+9rPW3Swq2hwAQQ2HrAwoTaeKPgh3tusVxhRAyEmq2vVwGWmuiciuDUSr45hMYMEGb8SwocFdW17gx6b+MYivcQ4UQv+Jgmt1r00tyBd5qcavUISM/xmYqNfj+oxYCpuHto+DSYmkD1LCgObSe8JJ2BMYH1ShF7GoLprvnEh1BhxhYQj9zHqnlgee3j96IeAT+nfB0mOgK06pzMqXUAwJ0ip1F5zSzDhRfE/6Y9GLI5O3mPNeU1LMH70DTPoPHwFg4+Cvo9UGkuYO5ZQBsEPZIAXalW8f11u5O5wA5wQPv/v9Q1NCfjMsu3UiGG7pNemOkOatzIn22aP4ys8Zfrq+UfgDuRsQcevwmSEnhcyQ9CbZv1T28wTHU8WhF3vwB/f93Z2rJorvJuHuJFk/aBPckeQW3eDxgks3L1dZM2nIIeYrUkE3oey223eVQQa/YWAfOF8svVt2HbtQPjhGGj6858xvTYi4FErZA2P5nojgJ7jSdSMWiu8dLt/KjNHTDEIPaYCKvt0qtgS36gV0QCbXGyrSTNIXrXhCeX71SYvJbjPMYmSH94tY6KERSpSd5ixVaVYKbZVbyww8ZTD1PBeL42esSCaZsCAwEAAQ==",
          "issuer": {
            "country": "KZ",
            "commonName": "НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
            "organization": "РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»",
            "dn": "CN=НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA),O=РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»,C=KZ"
          },
          "notBefore": "2015-07-27 11:22:53",
          "keyUser": []
        }
      ],
      "keyUsage": "AUTH",
      "serialNumber": "122684438670642568061334282296011886211357830154",
      "subject": {
        "lastName": "ТЕСТОВИЧ",
        "country": "KZ",
        "commonName": "ТЕСТОВ ТЕСТ",
        "gender": "",
        "surname": "ТЕСТОВ",
        "locality": "АЛМАТЫ",
        "dn": "CN=ТЕСТОВ ТЕСТ,SURNAME=ТЕСТОВ,SERIALNUMBER=IIN123456789011,C=KZ,L=АЛМАТЫ,S=АЛМАТЫ,G=ТЕСТОВИЧ",
        "state": "АЛМАТЫ",
        "birthDate": "12-34-56",
        "iin": "123456789011"
      },
      "signAlg": "SHA256WithRSAEncryption",
      "sign": "LLQvGPQP+rdLBTPRf0EgLIo/D9TqxeZ52pRyuCHNm5P2iOdSn3DuDid1k4pNFHFDIuJRhv2d4ndIZW4X9dhyzs6+unlEY00e5VRHxtDP1xtZ387apFRjqqWDhlKNiyMVhpCbyj647no+6pYbXbk7tc1R0BQc0FzaFSuueAYpTQUrGUHKDEum9N/gj2rdADQ8noycetQqWivixEZqviEwkJuvF4wbim/cnH+v1+wrLt/7Jl5CjdPhcAheZRNcXxQLce0iujEA/rISgSEbvqhLeq9hzUr+SsjjyO7lVjGbMRps2pGGKIQGmhwjAKoUsuj3HcIq5SS4DunASJvhhwI3EJO5wK133Hx0aBlE198lXh178CNr9U/ziryvGZzKiBtRDO89v7b/MpGHpzFjGdGy4vjBZRX5/Gn+6zLSYkxuhAXshxEV7V9eixTRFZiYochM4INuzQ0rFOftNLEQoxh0k3pieAKYqWbBH/4B/GE3VAxJClT+bwaXCX5/nBkgvkxAlWGutYi16HS2dv464NAfPiDa+YPbGrmNRAMUiuNc53LjNOiozq2Ku3ecYOxuVaByCw9pznQUtPX66btbbpSya1n3/Be+TFgL2QvmBRfndUP9twqSLx+iCOs2hgRmI5FGqbC9nkRV7jDcd9vtgKdzc3OGEiDqGqbO6Zc0KAsK3ao=",
      "publicKey": "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtKWLOJf9qCqA6EO/SVtiMuPZ8q3Sg2RjO0dWXqKQRP7BWhIyMucMv+WmpRs8RuJ987Hm3B/JszSdiPrmtA9BpIERKphRwp3n4QR6pfLUBEp+5QNetNsv+dbiPcefWCzgJZCqEZVbPvSkiFH20y13YQ2FhEBUp4lLOqydBD2CsDVoTusvLanEgR+AdziJPq2+iXwhttpNPShKRTXGbGkxUa4P7YMUCUqWstR7svLaJqxKDMhaR7MpEt56a2pfntm5oFxKNFoBQjRXKbiBNIKciMRAeznjezv9ZA98WzWPIMuWzi38fPW5X7IVqa7ZbAFWvZIHWJmrl57uKGBNd9EUewIDAQAB",
      "issuer": {
        "commonName": "ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
        "country": "KZ",
        "dn": "C=KZ,CN=ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)"
      },
      "notBefore": "2018-08-22 18:11:36",
      "keyUser": [
        "INDIVIDUAL"
      ]
    }
  }
}
```

</p>
</details>

<details>
<summary><code>GET /x509/info</code> - get detailed information about a certificate</summary>
<p>

Parameters (json):
- cert [string,required] - X509 certificate in Base64 format
- verify_ocsp [boolean,optional] - Conduct revocation check via OCSP
- verify_crl [boolean,optional] - Conduct revocation check via CRL
</p>

<p>

Success response:
```json
{
  "result": {
    "valid": true,
    "notAfter": "2019-08-22 18:11:36",
    "chain": [
      {
        "valid": true,
        "notAfter": "2019-08-22 18:11:36",
        "keyUsage": "AUTH",
        "serialNumber": "122684438670642568061334282296011886211357830154",
        "subject": {
          "lastName": "ТЕСТОВИЧ",
          "country": "KZ",
          "commonName": "ТЕСТОВ ТЕСТ",
          "gender": "",
          "surname": "ТЕСТОВ",
          "locality": "АЛМАТЫ",
          "dn": "CN=ТЕСТОВ ТЕСТ,SURNAME=ТЕСТОВ,SERIALNUMBER=IIN123456789011,C=KZ,L=АЛМАТЫ,S=АЛМАТЫ,G=ТЕСТОВИЧ",
          "state": "АЛМАТЫ",
          "birthDate": "12-34-56",
          "iin": "123456789011"
        },
        "signAlg": "SHA256WithRSAEncryption",
        "sign": "LLQvGPQP+rdLBTPRf0EgLIo/D9TqxeZ52pRyuCHNm5P2iOdSn3DuDid1k4pNFHFDIuJRhv2d4ndIZW4X9dhyzs6+unlEY00e5VRHxtDP1xtZ387apFRjqqWDhlKNiyMVhpCbyj647no+6pYbXbk7tc1R0BQc0FzaFSuueAYpTQUrGUHKDEum9N/gj2rdADQ8noycetQqWivixEZqviEwkJuvF4wbim/cnH+v1+wrLt/7Jl5CjdPhcAheZRNcXxQLce0iujEA/rISgSEbvqhLeq9hzUr+SsjjyO7lVjGbMRps2pGGKIQGmhwjAKoUsuj3HcIq5SS4DunASJvhhwI3EJO5wK133Hx0aBlE198lXh178CNr9U/ziryvGZzKiBtRDO89v7b/MpGHpzFjGdGy4vjBZRX5/Gn+6zLSYkxuhAXshxEV7V9eixTRFZiYochM4INuzQ0rFOftNLEQoxh0k3pieAKYqWbBH/4B/GE3VAxJClT+bwaXCX5/nBkgvkxAlWGutYi16HS2dv464NAfPiDa+YPbGrmNRAMUiuNc53LjNOiozq2Ku3ecYOxuVaByCw9pznQUtPX66btbbpSya1n3/Be+TFgL2QvmBRfndUP9twqSLx+iCOs2hgRmI5FGqbC9nkRV7jDcd9vtgKdzc3OGEiDqGqbO6Zc0KAsK3ao=",
        "publicKey": "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtKWLOJf9qCqA6EO/SVtiMuPZ8q3Sg2RjO0dWXqKQRP7BWhIyMucMv+WmpRs8RuJ987Hm3B/JszSdiPrmtA9BpIERKphRwp3n4QR6pfLUBEp+5QNetNsv+dbiPcefWCzgJZCqEZVbPvSkiFH20y13YQ2FhEBUp4lLOqydBD2CsDVoTusvLanEgR+AdziJPq2+iXwhttpNPShKRTXGbGkxUa4P7YMUCUqWstR7svLaJqxKDMhaR7MpEt56a2pfntm5oFxKNFoBQjRXKbiBNIKciMRAeznjezv9ZA98WzWPIMuWzi38fPW5X7IVqa7ZbAFWvZIHWJmrl57uKGBNd9EUewIDAQAB",
        "issuer": {
          "commonName": "ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
          "country": "KZ",
          "dn": "C=KZ,CN=ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)"
        },
        "notBefore": "2018-08-22 18:11:36",
        "keyUser": [
          "INDIVIDUAL"
        ]
      },
      {
        "valid": true,
        "notAfter": "2025-06-25 10:26:36",
        "keyUsage": "UNKNOWN",
        "serialNumber": "305229402244045643062022638026814839687773800430",
        "subject": {
          "commonName": "ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
          "country": "KZ",
          "dn": "C=KZ,CN=ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)"
        },
        "signAlg": "SHA256WithRSAEncryption",
        "sign": "Ddx8a01Z3HOMbVrvQcQZVS8yzIJRCYaEMbLYoWyDsMpoMB68jchHJ5ovGE4Qd2J/ihyzGe4+vRrtA9zKy98VrrJO+WPZoibepdj8tr4uU6WM0KiPcQTOMVLJJSEC/U0C+eWa5j6OpbRnQuQuJXZA/5eUJ5WMCZJae6vlIuVsNR7fnJgHdcYnxSXvgLHt9YkN1PZOuCHmFNI09U/isiUs004dRxe5a0AFVXwWy2v3DcL6K6Uq9ptBolaEy6mwYPXuVFRaZMyRFAL30vrIiU7k8dHGsNzY0Y2f+cwlfOtW049GIkTYmE6DV3zkNAKs0AhS1aDZq/epsV2R5c8Je33EF4E+SkcDuAK1h/xr8czx3Bi+tdoltlgqCHXT/dXX68L3ioelOTsLTfPYxVO2Itm3PGqfc3V5kyvz0Grgc9M8yNAKDuncn1qwzioy9ZgPiWNTqmm9M/KjyVTT3qoDmPsfFHkGwiEqUBWEyCSWEjDALbDiIvI2PuOx48O3coB7dfW0s2ClhfOvLrUKDMxVJJ1yJXOZb78ckfLlnllJrwCkPS7a43K6zK8ba5zi63TcAASCRpR+CPcEnChHPh4s8dCPu9oexo4/0ZdXbMDesYwylndleu2WGcFaxiSWix9Jpas50AH0qnijfDlGlVFZSPcBENrdb3M7iNgWIbzavtKG7nQ=",
        "publicKey": "MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEArlvMc9X0xktVYz/TmbbFKzkNnX5ZDqRN748xjaE5v/nbv56n0h2+UDG3NCW9uvpDojwmD0Vg5YVB11ASoyh6KmxpPy9vsXnr1UingzcEuz3X4vXElWFGGiWCidauN32fc3TqkS+CJc4PYHGVak8ifFU29MtEi4OOw7rko57Jl4HMuc+FRoQsb1Nw+e9m312i5xoLzxxpL1EVE1EObTfJ+4H4skT7me5f6zJwxUuQAojQAe7ghx2XoOKSo/aX8wHcFJydDsLPNMIqfmm6rpHTpW45X0QuEJpvwlIXa/Ovh5C4cActfPrX8s3ba8Ug0YwZvwuxLhKQIDP/fSxidMKwOVwAyJCLYV30dtwEwcSVfBCyg3/k5aWofgK2ZHnm6Z4+9sLAJGZkXXabrokr8nr0IOPnlioQMuGqYif4GFUy/VlWlanLcOSvi2sfdqDJeQ4XSOP1tazhifmBITKNwtZFv1e95i0OIH0mkGftZEax3BJ3Oi2Gk3xVxP0s5ImHgkrLztYiT2QuDC5MqyZ7NX0Q4k9dEYEBqbEAYvE1M8V7QCvqM+pBfS0MmMasgGrQsb22kYJ6MS4qQVK6IvOJT/IKqOUNT5HzFRYwqygzpHQQvHlkt8PGVcwK9m1F6WwbKecv2S2NuR+WQPI2aU2Qf3hL6Ooi0C4wH4noFbkf34+qXVUCAwEAAQ==",
        "issuer": {
          "country": "KZ",
          "commonName": "НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
          "organization": "РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»",
          "dn": "CN=НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA),O=РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»,C=KZ"
        },
        "notBefore": "2018-08-08 10:26:36",
        "keyUser": []
      },
      {
        "valid": true,
        "notAfter": "2025-07-27 11:22:53",
        "keyUsage": "UNKNOWN",
        "serialNumber": "483236974449879461588506755984708205979682368059",
        "subject": {
          "country": "KZ",
          "commonName": "НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
          "organization": "РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»",
          "dn": "CN=НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA),O=РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»,C=KZ"
        },
        "signAlg": "SHA256WithRSAEncryption",
        "sign": "WkjJgzPV7GDmpd9N38h9o8M+t/rpeJvEgReNzsT10fwKV3exmxwoiyFXAOjHf+lAVITj2kdcRUiD1Gr7vaWUCBpXeAMpKukfov31jG0q9Er0mWfs9iDaow66AwPa1zqh9kW8/xuEQVz/iI9Gl6F9q8bdEvFyb4xuD7TqFlqLIO7Z6oJlJZatIEACKFTTjd54d8+7/MJ3OVxfhe8ozMfXywQ3C7sjM9uSKzkgZZHmjpWTGljfAnjqP3ACLMEx1bxW+sKjjzrlRcML5iKDt8HJ2N/MtU7putMoMAAd5x79RPvZSV9h9fW4/qdnfwwneieh/w+KWJN+X6b9wMVWTh24CVif+NyCYqQFwr1RYkKtcBzSiRmmXh/rmPm4jmefGg6jNycbF66OcVI/HxnIH0zAZaVGM6eSLrbdiXjr9OSG2nt+qIkSsytjxCPuoLzLkJxYexZbDWcEDd9G2GpvYgIyFo8+ycJpdLJBa5wPUn8brd4rWnadmzjptt8LYWxrG8XcnJc2N78emf7MFP4LXyHypht+v+bWWO9uze0l6p4Z2JcPg3CFvEftAsKBkXCusE7nOgXq8kVTNBTmB3PfUcq3Ss3+QPwdziMsW8SLeEnO5Rcec7HAOrI2t24QY9htRREwUAGjAJQfDRrjEP+zzoazILyKPn6tGXhRcDybTrqqjRQ=",
        "publicKey": "MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAlqLdP8Z8G8sr5fWi+lp8r2fqRe2NLsiuHntkNTqu11bnY7h+q5LlAbTVJiPfFRchqegg64shKdqNy+9rPW3Swq2hwAQQ2HrAwoTaeKPgh3tusVxhRAyEmq2vVwGWmuiciuDUSr45hMYMEGb8SwocFdW17gx6b+MYivcQ4UQv+Jgmt1r00tyBd5qcavUISM/xmYqNfj+oxYCpuHto+DSYmkD1LCgObSe8JJ2BMYH1ShF7GoLprvnEh1BhxhYQj9zHqnlgee3j96IeAT+nfB0mOgK06pzMqXUAwJ0ip1F5zSzDhRfE/6Y9GLI5O3mPNeU1LMH70DTPoPHwFg4+Cvo9UGkuYO5ZQBsEPZIAXalW8f11u5O5wA5wQPv/v9Q1NCfjMsu3UiGG7pNemOkOatzIn22aP4ys8Zfrq+UfgDuRsQcevwmSEnhcyQ9CbZv1T28wTHU8WhF3vwB/f93Z2rJorvJuHuJFk/aBPckeQW3eDxgks3L1dZM2nIIeYrUkE3oey223eVQQa/YWAfOF8svVt2HbtQPjhGGj6858xvTYi4FErZA2P5nojgJ7jSdSMWiu8dLt/KjNHTDEIPaYCKvt0qtgS36gV0QCbXGyrSTNIXrXhCeX71SYvJbjPMYmSH94tY6KERSpSd5ixVaVYKbZVbyww8ZTD1PBeL42esSCaZsCAwEAAQ==",
        "issuer": {
          "country": "KZ",
          "commonName": "НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
          "organization": "РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»",
          "dn": "CN=НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA),O=РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»,C=KZ"
        },
        "notBefore": "2015-07-27 11:22:53",
        "keyUser": []
      }
    ],
    "keyUsage": "AUTH",
    "serialNumber": "122684438670642568061334282296011886211357830154",
    "subject": {
      "lastName": "ТЕСТОВИЧ",
      "country": "KZ",
      "commonName": "ТЕСТОВ ТЕСТ",
      "gender": "",
      "surname": "ТЕСТОВ",
      "locality": "АЛМАТЫ",
      "dn": "CN=ТЕСТОВ ТЕСТ,SURNAME=ТЕСТОВ,SERIALNUMBER=IIN123456789011,C=KZ,L=АЛМАТЫ,S=АЛМАТЫ,G=ТЕСТОВИЧ",
      "state": "АЛМАТЫ",
      "birthDate": "12-34-56",
      "iin": "123456789011"
    },
    "signAlg": "SHA256WithRSAEncryption",
    "sign": "LLQvGPQP+rdLBTPRf0EgLIo/D9TqxeZ52pRyuCHNm5P2iOdSn3DuDid1k4pNFHFDIuJRhv2d4ndIZW4X9dhyzs6+unlEY00e5VRHxtDP1xtZ387apFRjqqWDhlKNiyMVhpCbyj647no+6pYbXbk7tc1R0BQc0FzaFSuueAYpTQUrGUHKDEum9N/gj2rdADQ8noycetQqWivixEZqviEwkJuvF4wbim/cnH+v1+wrLt/7Jl5CjdPhcAheZRNcXxQLce0iujEA/rISgSEbvqhLeq9hzUr+SsjjyO7lVjGbMRps2pGGKIQGmhwjAKoUsuj3HcIq5SS4DunASJvhhwI3EJO5wK133Hx0aBlE198lXh178CNr9U/ziryvGZzKiBtRDO89v7b/MpGHpzFjGdGy4vjBZRX5/Gn+6zLSYkxuhAXshxEV7V9eixTRFZiYochM4INuzQ0rFOftNLEQoxh0k3pieAKYqWbBH/4B/GE3VAxJClT+bwaXCX5/nBkgvkxAlWGutYi16HS2dv464NAfPiDa+YPbGrmNRAMUiuNc53LjNOiozq2Ku3ecYOxuVaByCw9pznQUtPX66btbbpSya1n3/Be+TFgL2QvmBRfndUP9twqSLx+iCOs2hgRmI5FGqbC9nkRV7jDcd9vtgKdzc3OGEiDqGqbO6Zc0KAsK3ao=",
    "publicKey": "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtKWLOJf9qCqA6EO/SVtiMuPZ8q3Sg2RjO0dWXqKQRP7BWhIyMucMv+WmpRs8RuJ987Hm3B/JszSdiPrmtA9BpIERKphRwp3n4QR6pfLUBEp+5QNetNsv+dbiPcefWCzgJZCqEZVbPvSkiFH20y13YQ2FhEBUp4lLOqydBD2CsDVoTusvLanEgR+AdziJPq2+iXwhttpNPShKRTXGbGkxUa4P7YMUCUqWstR7svLaJqxKDMhaR7MpEt56a2pfntm5oFxKNFoBQjRXKbiBNIKciMRAeznjezv9ZA98WzWPIMuWzi38fPW5X7IVqa7ZbAFWvZIHWJmrl57uKGBNd9EUewIDAQAB",
    "issuer": {
      "commonName": "ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
      "country": "KZ",
      "dn": "C=KZ,CN=ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)"
    },
    "notBefore": "2018-08-22 18:11:36",
    "keyUser": [
      "INDIVIDUAL"
    ]
  }
}
```
</p>
</details>

<details>
<summary><code>POST /xml/verify</code> - verify xml-sign</summary>
<p>

Parameters (json):
- xml [string,required] - XML with signature in Base64 format
- verify_ocsp [boolean,optional] - Conduct revocation check via OCSP
- verify_crl [boolean,optional] - Conduct revocation check via CRL
</p>

<p>

Success response:
```json
{
  "result": {
    "valid": true,
    "cert": {
      "valid": true,
      "notAfter": "2019-08-22 18:11:36",
      "chain": [
        {
          "valid": true,
          "notAfter": "2019-08-22 18:11:36",
          "keyUsage": "AUTH",
          "serialNumber": "122684438670642568061334282296011886211357830154",
          "subject": {
            "lastName": "ТЕСТОВИЧ",
            "country": "KZ",
            "commonName": "ТЕСТОВ ТЕСТ",
            "gender": "",
            "surname": "ТЕСТОВ",
            "locality": "АЛМАТЫ",
            "dn": "CN=ТЕСТОВ ТЕСТ,SURNAME=ТЕСТОВ,SERIALNUMBER=IIN123456789011,C=KZ,L=АЛМАТЫ,S=АЛМАТЫ,G=ТЕСТОВИЧ",
            "state": "АЛМАТЫ",
            "birthDate": "12-34-56",
            "iin": "123456789011"
          },
          "signAlg": "SHA256WithRSAEncryption",
          "sign": "LLQvGPQP+rdLBTPRf0EgLIo/D9TqxeZ52pRyuCHNm5P2iOdSn3DuDid1k4pNFHFDIuJRhv2d4ndIZW4X9dhyzs6+unlEY00e5VRHxtDP1xtZ387apFRjqqWDhlKNiyMVhpCbyj647no+6pYbXbk7tc1R0BQc0FzaFSuueAYpTQUrGUHKDEum9N/gj2rdADQ8noycetQqWivixEZqviEwkJuvF4wbim/cnH+v1+wrLt/7Jl5CjdPhcAheZRNcXxQLce0iujEA/rISgSEbvqhLeq9hzUr+SsjjyO7lVjGbMRps2pGGKIQGmhwjAKoUsuj3HcIq5SS4DunASJvhhwI3EJO5wK133Hx0aBlE198lXh178CNr9U/ziryvGZzKiBtRDO89v7b/MpGHpzFjGdGy4vjBZRX5/Gn+6zLSYkxuhAXshxEV7V9eixTRFZiYochM4INuzQ0rFOftNLEQoxh0k3pieAKYqWbBH/4B/GE3VAxJClT+bwaXCX5/nBkgvkxAlWGutYi16HS2dv464NAfPiDa+YPbGrmNRAMUiuNc53LjNOiozq2Ku3ecYOxuVaByCw9pznQUtPX66btbbpSya1n3/Be+TFgL2QvmBRfndUP9twqSLx+iCOs2hgRmI5FGqbC9nkRV7jDcd9vtgKdzc3OGEiDqGqbO6Zc0KAsK3ao=",
          "publicKey": "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtKWLOJf9qCqA6EO/SVtiMuPZ8q3Sg2RjO0dWXqKQRP7BWhIyMucMv+WmpRs8RuJ987Hm3B/JszSdiPrmtA9BpIERKphRwp3n4QR6pfLUBEp+5QNetNsv+dbiPcefWCzgJZCqEZVbPvSkiFH20y13YQ2FhEBUp4lLOqydBD2CsDVoTusvLanEgR+AdziJPq2+iXwhttpNPShKRTXGbGkxUa4P7YMUCUqWstR7svLaJqxKDMhaR7MpEt56a2pfntm5oFxKNFoBQjRXKbiBNIKciMRAeznjezv9ZA98WzWPIMuWzi38fPW5X7IVqa7ZbAFWvZIHWJmrl57uKGBNd9EUewIDAQAB",
          "issuer": {
            "commonName": "ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
            "country": "KZ",
            "dn": "C=KZ,CN=ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)"
          },
          "notBefore": "2018-08-22 18:11:36",
          "keyUser": [
            "INDIVIDUAL"
          ]
        },
        {
          "valid": true,
          "notAfter": "2025-06-25 10:26:36",
          "keyUsage": "UNKNOWN",
          "serialNumber": "305229402244045643062022638026814839687773800430",
          "subject": {
            "commonName": "ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
            "country": "KZ",
            "dn": "C=KZ,CN=ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)"
          },
          "signAlg": "SHA256WithRSAEncryption",
          "sign": "Ddx8a01Z3HOMbVrvQcQZVS8yzIJRCYaEMbLYoWyDsMpoMB68jchHJ5ovGE4Qd2J/ihyzGe4+vRrtA9zKy98VrrJO+WPZoibepdj8tr4uU6WM0KiPcQTOMVLJJSEC/U0C+eWa5j6OpbRnQuQuJXZA/5eUJ5WMCZJae6vlIuVsNR7fnJgHdcYnxSXvgLHt9YkN1PZOuCHmFNI09U/isiUs004dRxe5a0AFVXwWy2v3DcL6K6Uq9ptBolaEy6mwYPXuVFRaZMyRFAL30vrIiU7k8dHGsNzY0Y2f+cwlfOtW049GIkTYmE6DV3zkNAKs0AhS1aDZq/epsV2R5c8Je33EF4E+SkcDuAK1h/xr8czx3Bi+tdoltlgqCHXT/dXX68L3ioelOTsLTfPYxVO2Itm3PGqfc3V5kyvz0Grgc9M8yNAKDuncn1qwzioy9ZgPiWNTqmm9M/KjyVTT3qoDmPsfFHkGwiEqUBWEyCSWEjDALbDiIvI2PuOx48O3coB7dfW0s2ClhfOvLrUKDMxVJJ1yJXOZb78ckfLlnllJrwCkPS7a43K6zK8ba5zi63TcAASCRpR+CPcEnChHPh4s8dCPu9oexo4/0ZdXbMDesYwylndleu2WGcFaxiSWix9Jpas50AH0qnijfDlGlVFZSPcBENrdb3M7iNgWIbzavtKG7nQ=",
          "publicKey": "MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEArlvMc9X0xktVYz/TmbbFKzkNnX5ZDqRN748xjaE5v/nbv56n0h2+UDG3NCW9uvpDojwmD0Vg5YVB11ASoyh6KmxpPy9vsXnr1UingzcEuz3X4vXElWFGGiWCidauN32fc3TqkS+CJc4PYHGVak8ifFU29MtEi4OOw7rko57Jl4HMuc+FRoQsb1Nw+e9m312i5xoLzxxpL1EVE1EObTfJ+4H4skT7me5f6zJwxUuQAojQAe7ghx2XoOKSo/aX8wHcFJydDsLPNMIqfmm6rpHTpW45X0QuEJpvwlIXa/Ovh5C4cActfPrX8s3ba8Ug0YwZvwuxLhKQIDP/fSxidMKwOVwAyJCLYV30dtwEwcSVfBCyg3/k5aWofgK2ZHnm6Z4+9sLAJGZkXXabrokr8nr0IOPnlioQMuGqYif4GFUy/VlWlanLcOSvi2sfdqDJeQ4XSOP1tazhifmBITKNwtZFv1e95i0OIH0mkGftZEax3BJ3Oi2Gk3xVxP0s5ImHgkrLztYiT2QuDC5MqyZ7NX0Q4k9dEYEBqbEAYvE1M8V7QCvqM+pBfS0MmMasgGrQsb22kYJ6MS4qQVK6IvOJT/IKqOUNT5HzFRYwqygzpHQQvHlkt8PGVcwK9m1F6WwbKecv2S2NuR+WQPI2aU2Qf3hL6Ooi0C4wH4noFbkf34+qXVUCAwEAAQ==",
          "issuer": {
            "country": "KZ",
            "commonName": "НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
            "organization": "РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»",
            "dn": "CN=НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA),O=РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»,C=KZ"
          },
          "notBefore": "2018-08-08 10:26:36",
          "keyUser": []
        },
        {
          "valid": true,
          "notAfter": "2025-07-27 11:22:53",
          "keyUsage": "UNKNOWN",
          "serialNumber": "483236974449879461588506755984708205979682368059",
          "subject": {
            "country": "KZ",
            "commonName": "НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
            "organization": "РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»",
            "dn": "CN=НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA),O=РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»,C=KZ"
          },
          "signAlg": "SHA256WithRSAEncryption",
          "sign": "WkjJgzPV7GDmpd9N38h9o8M+t/rpeJvEgReNzsT10fwKV3exmxwoiyFXAOjHf+lAVITj2kdcRUiD1Gr7vaWUCBpXeAMpKukfov31jG0q9Er0mWfs9iDaow66AwPa1zqh9kW8/xuEQVz/iI9Gl6F9q8bdEvFyb4xuD7TqFlqLIO7Z6oJlJZatIEACKFTTjd54d8+7/MJ3OVxfhe8ozMfXywQ3C7sjM9uSKzkgZZHmjpWTGljfAnjqP3ACLMEx1bxW+sKjjzrlRcML5iKDt8HJ2N/MtU7putMoMAAd5x79RPvZSV9h9fW4/qdnfwwneieh/w+KWJN+X6b9wMVWTh24CVif+NyCYqQFwr1RYkKtcBzSiRmmXh/rmPm4jmefGg6jNycbF66OcVI/HxnIH0zAZaVGM6eSLrbdiXjr9OSG2nt+qIkSsytjxCPuoLzLkJxYexZbDWcEDd9G2GpvYgIyFo8+ycJpdLJBa5wPUn8brd4rWnadmzjptt8LYWxrG8XcnJc2N78emf7MFP4LXyHypht+v+bWWO9uze0l6p4Z2JcPg3CFvEftAsKBkXCusE7nOgXq8kVTNBTmB3PfUcq3Ss3+QPwdziMsW8SLeEnO5Rcec7HAOrI2t24QY9htRREwUAGjAJQfDRrjEP+zzoazILyKPn6tGXhRcDybTrqqjRQ=",
          "publicKey": "MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAlqLdP8Z8G8sr5fWi+lp8r2fqRe2NLsiuHntkNTqu11bnY7h+q5LlAbTVJiPfFRchqegg64shKdqNy+9rPW3Swq2hwAQQ2HrAwoTaeKPgh3tusVxhRAyEmq2vVwGWmuiciuDUSr45hMYMEGb8SwocFdW17gx6b+MYivcQ4UQv+Jgmt1r00tyBd5qcavUISM/xmYqNfj+oxYCpuHto+DSYmkD1LCgObSe8JJ2BMYH1ShF7GoLprvnEh1BhxhYQj9zHqnlgee3j96IeAT+nfB0mOgK06pzMqXUAwJ0ip1F5zSzDhRfE/6Y9GLI5O3mPNeU1LMH70DTPoPHwFg4+Cvo9UGkuYO5ZQBsEPZIAXalW8f11u5O5wA5wQPv/v9Q1NCfjMsu3UiGG7pNemOkOatzIn22aP4ys8Zfrq+UfgDuRsQcevwmSEnhcyQ9CbZv1T28wTHU8WhF3vwB/f93Z2rJorvJuHuJFk/aBPckeQW3eDxgks3L1dZM2nIIeYrUkE3oey223eVQQa/YWAfOF8svVt2HbtQPjhGGj6858xvTYi4FErZA2P5nojgJ7jSdSMWiu8dLt/KjNHTDEIPaYCKvt0qtgS36gV0QCbXGyrSTNIXrXhCeX71SYvJbjPMYmSH94tY6KERSpSd5ixVaVYKbZVbyww8ZTD1PBeL42esSCaZsCAwEAAQ==",
          "issuer": {
            "country": "KZ",
            "commonName": "НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
            "organization": "РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»",
            "dn": "CN=НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA),O=РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»,C=KZ"
          },
          "notBefore": "2015-07-27 11:22:53",
          "keyUser": []
        }
      ],
      "keyUsage": "AUTH",
      "serialNumber": "122684438670642568061334282296011886211357830154",
      "subject": {
        "lastName": "ТЕСТОВИЧ",
        "country": "KZ",
        "commonName": "ТЕСТОВ ТЕСТ",
        "gender": "",
        "surname": "ТЕСТОВ",
        "locality": "АЛМАТЫ",
        "dn": "CN=ТЕСТОВ ТЕСТ,SURNAME=ТЕСТОВ,SERIALNUMBER=IIN123456789011,C=KZ,L=АЛМАТЫ,S=АЛМАТЫ,G=ТЕСТОВИЧ",
        "state": "АЛМАТЫ",
        "birthDate": "12-34-56",
        "iin": "123456789011"
      },
      "signAlg": "SHA256WithRSAEncryption",
      "sign": "LLQvGPQP+rdLBTPRf0EgLIo/D9TqxeZ52pRyuCHNm5P2iOdSn3DuDid1k4pNFHFDIuJRhv2d4ndIZW4X9dhyzs6+unlEY00e5VRHxtDP1xtZ387apFRjqqWDhlKNiyMVhpCbyj647no+6pYbXbk7tc1R0BQc0FzaFSuueAYpTQUrGUHKDEum9N/gj2rdADQ8noycetQqWivixEZqviEwkJuvF4wbim/cnH+v1+wrLt/7Jl5CjdPhcAheZRNcXxQLce0iujEA/rISgSEbvqhLeq9hzUr+SsjjyO7lVjGbMRps2pGGKIQGmhwjAKoUsuj3HcIq5SS4DunASJvhhwI3EJO5wK133Hx0aBlE198lXh178CNr9U/ziryvGZzKiBtRDO89v7b/MpGHpzFjGdGy4vjBZRX5/Gn+6zLSYkxuhAXshxEV7V9eixTRFZiYochM4INuzQ0rFOftNLEQoxh0k3pieAKYqWbBH/4B/GE3VAxJClT+bwaXCX5/nBkgvkxAlWGutYi16HS2dv464NAfPiDa+YPbGrmNRAMUiuNc53LjNOiozq2Ku3ecYOxuVaByCw9pznQUtPX66btbbpSya1n3/Be+TFgL2QvmBRfndUP9twqSLx+iCOs2hgRmI5FGqbC9nkRV7jDcd9vtgKdzc3OGEiDqGqbO6Zc0KAsK3ao=",
      "publicKey": "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtKWLOJf9qCqA6EO/SVtiMuPZ8q3Sg2RjO0dWXqKQRP7BWhIyMucMv+WmpRs8RuJ987Hm3B/JszSdiPrmtA9BpIERKphRwp3n4QR6pfLUBEp+5QNetNsv+dbiPcefWCzgJZCqEZVbPvSkiFH20y13YQ2FhEBUp4lLOqydBD2CsDVoTusvLanEgR+AdziJPq2+iXwhttpNPShKRTXGbGkxUa4P7YMUCUqWstR7svLaJqxKDMhaR7MpEt56a2pfntm5oFxKNFoBQjRXKbiBNIKciMRAeznjezv9ZA98WzWPIMuWzi38fPW5X7IVqa7ZbAFWvZIHWJmrl57uKGBNd9EUewIDAQAB",
      "issuer": {
        "commonName": "ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
        "country": "KZ",
        "dn": "C=KZ,CN=ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)"
      },
      "notBefore": "2018-08-22 18:11:36",
      "keyUser": [
        "INDIVIDUAL"
      ]
    }
  }
}
```
</p>
</details>

<details>
<summary><code>POST /cms/verify</code> - verify CMS-sign and get info about every signer</summary>
<p>

Parameters (json):
- cms [string,required] - CMS-sign in Base64 format
- check_ocsp [boolean,optional] - Conduct revocation check via OCSP
- check_crl [boolean,optional] - Conduct revocation check via CRL
</p>

<p>

Success response:
```json
{
  "result": {
    "tsp": [
      {
        "tspHashAlgorithm": "SHA256",
        "serialNumber": "50dd664473d69798d2587ef85d9f949d4a102d74",
        "tsa": null,
        "genTime": "2021-02-12 10:46:16",
        "hash": "00ac7aa3981a649cd641b2e10cfd31d63794bc40725dbdfb847add41f7f34a6c",
        "policy": "1.2.398.3.3.2.6.2"
      }
    ],
    "signers": [
      {
        "chain": [
          {
            "valid": true,
            "notAfter": "2021-11-19 10:17:06",
            "keyUsage": "SIGN",
            "serialNumber": "153096684484683416879500240901684586471887259032",
            "subject": {
              "lastName": "МУХТАРҚЫЗЫ",
              "country": "KZ",
              "commonName": "БАЗАРБАЕВА ДИНАРА",
              "gender": "FEMALE",
              "surname": "БАЗАРБАЕВА",
              "dn": "CN=БАЗАРБАЕВА ДИНАРА,SURNAME=БАЗАРБАЕВА,SERIALNUMBER=IIN990915450319,C=KZ,G=МУХТАРҚЫЗЫ",
              "birthDate": "1999-09-15",
              "iin": "990915450319"
            },
            "signAlg": "SHA256WithRSAEncryption",
            "sign": "MA3zptdvFcnyYQg+OBz2TGLRQXKrAePJ78qpS71O4Wp7vaZjX7WgdUIRoy1jbZhcznLSU1VowGzltyTjXkJx0s12kEZnmLIqLjlKfZZPmXbfMscPQY7X\/8b52QW2Oe6MVktTkL5pB0kgIEzlaTdqoAFkmFj4eQJNiqQxHMjUHnfbSNVzIOxSDu6IzFpLGj3fNhhy+zaU6J6AzPMP\/TJ2m6bny\/U78QGiV5zzqV7IbGcYlSw0QEilYfXAkajV\/RC0H0ruFxOfggRcX6zzcCOrRsx48\/qk6IjGR0lfRPcIgquTj3MRSfQGEk1tQ3nK2qK5yZwhyl\/iwUwaf3\/G3wnjhvnHwEQCWJZUBf7NJu7RV1UzhjC1LQ1R\/w4jJamvTA9qIXZFpbpTriWlsUjeD8hzRv3Io5lP5tO\/\/gwaNvUAu\/\/R++yvy3dwekfDPQS\/\/RRWzuSoPoU28P2\/zy+oa\/+mo3rCDCms5FH1dIM+3V\/GuV3ASBeylgNOECNEeiPbMJ\/m+DJJedQkuUKivPzIeTvlzOXpM3MK8NnFd3Qe46vichnt\/8ulYpTC5+mtWZiJR8Cg1cHxYGZBcFrzn9LqSq2Sl2m5HsHf2rMC++wIXw1qkizZP0ysLuctceXt0kUm6GGYOWCr+g+v+lKByImUeaUnEWZJR7\/BEAzZeRbXZcFh+RE=",
            "publicKey": "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAm\/V7mmihPYenWUzJuBXR4LAaaGokMcG1gehbMqytiEfifjsolamxVKZUlQHrGFEsSSelcV4bDJ25yrCk3xm0Ny4jaJ8HwfQMg\/is7aqKcHJQdm\/uQU9tIolEpe2MbbZ5jO4kM8L5BYVM8ilrDJk+jtBSPUDnkaelEQL7mZlKbifwm7eyFbZ1FkNcXjjDNPlJo6YJ90XcI+9EpNGcmEnd+Pfn0rb0NviTdfFIMsb7WUG+K59ShxhyJRZhYjOH2kFZvuU5qpCr9QZCDBzyKj003z6If6zyzinOAsvH5yCigME1mcO2NwAQjEGC6sgvY6s7U\/ieaB86TpoFiuQ3Nc9+\/wIDAQAB",
            "issuer": {
              "commonName": "ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
              "country": "KZ",
              "dn": "C=KZ,CN=ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)"
            },
            "notBefore": "2020-11-19 10:17:06",
            "keyUser": [
              "INDIVIDUAL"
            ]
          },
          {
            "valid": true,
            "notAfter": "2025-06-25 04:26:36",
            "keyUsage": "UNKNOWN",
            "serialNumber": "305229402244045643062022638026814839687773800430",
            "subject": {
              "commonName": "ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
              "country": "KZ",
              "dn": "C=KZ,CN=ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)"
            },
            "signAlg": "SHA256WithRSAEncryption",
            "sign": "Ddx8a01Z3HOMbVrvQcQZVS8yzIJRCYaEMbLYoWyDsMpoMB68jchHJ5ovGE4Qd2J\/ihyzGe4+vRrtA9zKy98VrrJO+WPZoibepdj8tr4uU6WM0KiPcQTOMVLJJSEC\/U0C+eWa5j6OpbRnQuQuJXZA\/5eUJ5WMCZJae6vlIuVsNR7fnJgHdcYnxSXvgLHt9YkN1PZOuCHmFNI09U\/isiUs004dRxe5a0AFVXwWy2v3DcL6K6Uq9ptBolaEy6mwYPXuVFRaZMyRFAL30vrIiU7k8dHGsNzY0Y2f+cwlfOtW049GIkTYmE6DV3zkNAKs0AhS1aDZq\/epsV2R5c8Je33EF4E+SkcDuAK1h\/xr8czx3Bi+tdoltlgqCHXT\/dXX68L3ioelOTsLTfPYxVO2Itm3PGqfc3V5kyvz0Grgc9M8yNAKDuncn1qwzioy9ZgPiWNTqmm9M\/KjyVTT3qoDmPsfFHkGwiEqUBWEyCSWEjDALbDiIvI2PuOx48O3coB7dfW0s2ClhfOvLrUKDMxVJJ1yJXOZb78ckfLlnllJrwCkPS7a43K6zK8ba5zi63TcAASCRpR+CPcEnChHPh4s8dCPu9oexo4\/0ZdXbMDesYwylndleu2WGcFaxiSWix9Jpas50AH0qnijfDlGlVFZSPcBENrdb3M7iNgWIbzavtKG7nQ=",
            "publicKey": "MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEArlvMc9X0xktVYz\/TmbbFKzkNnX5ZDqRN748xjaE5v\/nbv56n0h2+UDG3NCW9uvpDojwmD0Vg5YVB11ASoyh6KmxpPy9vsXnr1UingzcEuz3X4vXElWFGGiWCidauN32fc3TqkS+CJc4PYHGVak8ifFU29MtEi4OOw7rko57Jl4HMuc+FRoQsb1Nw+e9m312i5xoLzxxpL1EVE1EObTfJ+4H4skT7me5f6zJwxUuQAojQAe7ghx2XoOKSo\/aX8wHcFJydDsLPNMIqfmm6rpHTpW45X0QuEJpvwlIXa\/Ovh5C4cActfPrX8s3ba8Ug0YwZvwuxLhKQIDP\/fSxidMKwOVwAyJCLYV30dtwEwcSVfBCyg3\/k5aWofgK2ZHnm6Z4+9sLAJGZkXXabrokr8nr0IOPnlioQMuGqYif4GFUy\/VlWlanLcOSvi2sfdqDJeQ4XSOP1tazhifmBITKNwtZFv1e95i0OIH0mkGftZEax3BJ3Oi2Gk3xVxP0s5ImHgkrLztYiT2QuDC5MqyZ7NX0Q4k9dEYEBqbEAYvE1M8V7QCvqM+pBfS0MmMasgGrQsb22kYJ6MS4qQVK6IvOJT\/IKqOUNT5HzFRYwqygzpHQQvHlkt8PGVcwK9m1F6WwbKecv2S2NuR+WQPI2aU2Qf3hL6Ooi0C4wH4noFbkf34+qXVUCAwEAAQ==",
            "issuer": {
              "country": "KZ",
              "commonName": "НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
              "organization": "РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»",
              "dn": "CN=НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA),O=РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»,C=KZ"
            },
            "notBefore": "2018-08-08 04:26:36",
            "keyUser": []
          },
          {
            "valid": true,
            "notAfter": "2025-07-27 05:22:53",
            "keyUsage": "UNKNOWN",
            "serialNumber": "483236974449879461588506755984708205979682368059",
            "subject": {
              "country": "KZ",
              "commonName": "НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
              "organization": "РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»",
              "dn": "CN=НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA),O=РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»,C=KZ"
            },
            "signAlg": "SHA256WithRSAEncryption",
            "sign": "WkjJgzPV7GDmpd9N38h9o8M+t\/rpeJvEgReNzsT10fwKV3exmxwoiyFXAOjHf+lAVITj2kdcRUiD1Gr7vaWUCBpXeAMpKukfov31jG0q9Er0mWfs9iDaow66AwPa1zqh9kW8\/xuEQVz\/iI9Gl6F9q8bdEvFyb4xuD7TqFlqLIO7Z6oJlJZatIEACKFTTjd54d8+7\/MJ3OVxfhe8ozMfXywQ3C7sjM9uSKzkgZZHmjpWTGljfAnjqP3ACLMEx1bxW+sKjjzrlRcML5iKDt8HJ2N\/MtU7putMoMAAd5x79RPvZSV9h9fW4\/qdnfwwneieh\/w+KWJN+X6b9wMVWTh24CVif+NyCYqQFwr1RYkKtcBzSiRmmXh\/rmPm4jmefGg6jNycbF66OcVI\/HxnIH0zAZaVGM6eSLrbdiXjr9OSG2nt+qIkSsytjxCPuoLzLkJxYexZbDWcEDd9G2GpvYgIyFo8+ycJpdLJBa5wPUn8brd4rWnadmzjptt8LYWxrG8XcnJc2N78emf7MFP4LXyHypht+v+bWWO9uze0l6p4Z2JcPg3CFvEftAsKBkXCusE7nOgXq8kVTNBTmB3PfUcq3Ss3+QPwdziMsW8SLeEnO5Rcec7HAOrI2t24QY9htRREwUAGjAJQfDRrjEP+zzoazILyKPn6tGXhRcDybTrqqjRQ=",
            "publicKey": "MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAlqLdP8Z8G8sr5fWi+lp8r2fqRe2NLsiuHntkNTqu11bnY7h+q5LlAbTVJiPfFRchqegg64shKdqNy+9rPW3Swq2hwAQQ2HrAwoTaeKPgh3tusVxhRAyEmq2vVwGWmuiciuDUSr45hMYMEGb8SwocFdW17gx6b+MYivcQ4UQv+Jgmt1r00tyBd5qcavUISM\/xmYqNfj+oxYCpuHto+DSYmkD1LCgObSe8JJ2BMYH1ShF7GoLprvnEh1BhxhYQj9zHqnlgee3j96IeAT+nfB0mOgK06pzMqXUAwJ0ip1F5zSzDhRfE\/6Y9GLI5O3mPNeU1LMH70DTPoPHwFg4+Cvo9UGkuYO5ZQBsEPZIAXalW8f11u5O5wA5wQPv\/v9Q1NCfjMsu3UiGG7pNemOkOatzIn22aP4ys8Zfrq+UfgDuRsQcevwmSEnhcyQ9CbZv1T28wTHU8WhF3vwB\/f93Z2rJorvJuHuJFk\/aBPckeQW3eDxgks3L1dZM2nIIeYrUkE3oey223eVQQa\/YWAfOF8svVt2HbtQPjhGGj6858xvTYi4FErZA2P5nojgJ7jSdSMWiu8dLt\/KjNHTDEIPaYCKvt0qtgS36gV0QCbXGyrSTNIXrXhCeX71SYvJbjPMYmSH94tY6KERSpSd5ixVaVYKbZVbyww8ZTD1PBeL42esSCaZsCAwEAAQ==",
            "issuer": {
              "country": "KZ",
              "commonName": "НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
              "organization": "РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»",
              "dn": "CN=НЕГІЗГІ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA),O=РМК «МЕМЛЕКЕТТІК ТЕХНИКАЛЫҚ ҚЫЗМЕТ»,C=KZ"
            },
            "notBefore": "2015-07-27 05:22:53",
            "keyUser": []
          }
        ],
        "cert": {
          "valid": true,
          "notAfter": "2021-11-19 10:17:06",
          "keyUsage": "SIGN",
          "serialNumber": "153096684484683416879500240901684586471887259032",
          "subject": {
            "lastName": "МУХТАРҚЫЗЫ",
            "country": "KZ",
            "commonName": "БАЗАРБАЕВА ДИНАРА",
            "gender": "FEMALE",
            "surname": "БАЗАРБАЕВА",
            "dn": "CN=БАЗАРБАЕВА ДИНАРА,SURNAME=БАЗАРБАЕВА,SERIALNUMBER=IIN990915450319,C=KZ,G=МУХТАРҚЫЗЫ",
            "birthDate": "1999-09-15",
            "iin": "990915450319"
          },
          "signAlg": "SHA256WithRSAEncryption",
          "sign": "MA3zptdvFcnyYQg+OBz2TGLRQXKrAePJ78qpS71O4Wp7vaZjX7WgdUIRoy1jbZhcznLSU1VowGzltyTjXkJx0s12kEZnmLIqLjlKfZZPmXbfMscPQY7X\/8b52QW2Oe6MVktTkL5pB0kgIEzlaTdqoAFkmFj4eQJNiqQxHMjUHnfbSNVzIOxSDu6IzFpLGj3fNhhy+zaU6J6AzPMP\/TJ2m6bny\/U78QGiV5zzqV7IbGcYlSw0QEilYfXAkajV\/RC0H0ruFxOfggRcX6zzcCOrRsx48\/qk6IjGR0lfRPcIgquTj3MRSfQGEk1tQ3nK2qK5yZwhyl\/iwUwaf3\/G3wnjhvnHwEQCWJZUBf7NJu7RV1UzhjC1LQ1R\/w4jJamvTA9qIXZFpbpTriWlsUjeD8hzRv3Io5lP5tO\/\/gwaNvUAu\/\/R++yvy3dwekfDPQS\/\/RRWzuSoPoU28P2\/zy+oa\/+mo3rCDCms5FH1dIM+3V\/GuV3ASBeylgNOECNEeiPbMJ\/m+DJJedQkuUKivPzIeTvlzOXpM3MK8NnFd3Qe46vichnt\/8ulYpTC5+mtWZiJR8Cg1cHxYGZBcFrzn9LqSq2Sl2m5HsHf2rMC++wIXw1qkizZP0ysLuctceXt0kUm6GGYOWCr+g+v+lKByImUeaUnEWZJR7\/BEAzZeRbXZcFh+RE=",
          "publicKey": "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAm\/V7mmihPYenWUzJuBXR4LAaaGokMcG1gehbMqytiEfifjsolamxVKZUlQHrGFEsSSelcV4bDJ25yrCk3xm0Ny4jaJ8HwfQMg\/is7aqKcHJQdm\/uQU9tIolEpe2MbbZ5jO4kM8L5BYVM8ilrDJk+jtBSPUDnkaelEQL7mZlKbifwm7eyFbZ1FkNcXjjDNPlJo6YJ90XcI+9EpNGcmEnd+Pfn0rb0NviTdfFIMsb7WUG+K59ShxhyJRZhYjOH2kFZvuU5qpCr9QZCDBzyKj003z6If6zyzinOAsvH5yCigME1mcO2NwAQjEGC6sgvY6s7U\/ieaB86TpoFiuQ3Nc9+\/wIDAQAB",
          "issuer": {
            "commonName": "ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)",
            "country": "KZ",
            "dn": "C=KZ,CN=ҰЛТТЫҚ КУӘЛАНДЫРУШЫ ОРТАЛЫҚ (RSA)"
          },
          "notBefore": "2020-11-19 10:17:06",
          "keyUser": [
            "INDIVIDUAL"
          ]
        }
      }
    ]
  }
}
```
</p>
</details>

<details>
<summary><code>GET /cms/extract</code> - get original data from CMS</summary>
<p>

Parameters (json):
- cms [string,required] - CMS-sign in Base64 format
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
  "signature": {
    "id": 1,
    "code": "ticket_12",
    "signature": "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",
    "parent_id": null,
    "created_at": ""
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
- parent_code [string,optional] - code of parent signature
- tags [array, optional] - array of tags
</p>

<p>

Success response:
```json
{
  "signature": {
    "id": 2,
    "code": "ticket_13",
    "signature": "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",
    "parent_id": null,
    "created_at": ""
  }
}
```
</p>
</details>

<details>
<summary><code>GET /signatures</code> - get signatures</summary>
<p>

Parameters (json):
- parent_code [string,optional] - code of parent signature
- tags [array, optional] - array of tags
- limit [integer, optional] - limit of fetching data
- offset [integer, optional] - offset of fetching data
</p>

<p>

Success response:
```json
{
  "signatures": [
    {
      "id": 2,
      "code": "ticket_13",
      "signature": "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",
      "parent_id": null,
      "created_at": ""
    },
    {
      "id": 1,
      "code": "ticket_12",
      "signature": "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",
      "parent_id": null,
      "created_at": ""
    }
  ]
}

```
</p>
</details>