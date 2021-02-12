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