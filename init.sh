#!/usr/bin/env bash

set -x \
&& rm -rf /etc/nginx \
&& rm -rf /etc/supervisor \
&& mkdir /run/php

set -x \
&& cp -r "/usr/share/container_config/nginx" /etc/nginx \
&& cp -r "/usr/share/container_config/supervisor" /etc/supervisor

sed -i "s/error_log = \/var\/log\/php7.4-fpm.log/error_log = \/dev\/stdout/g" /etc/php/7.4/fpm/php-fpm.conf
sed -i "s/;error_log = syslog/error_log = \/dev\/stdout/g" /etc/php/7.4/fpm/php.ini
sed -i "s/;error_log = syslog/error_log = \/dev\/stdout/g" /etc/php/7.4/cli/php.ini
sed -i "s/log_errors = Off/log_errors = On/g" /etc/php/7.4/cli/php.ini
sed -i "s/log_errors = Off/log_errors = On/g" /etc/php/7.4/fpm/php.ini
sed -i "s/log_errors_max_len = 1024/log_errors_max_len = 0/g" /etc/php/7.4/cli/php.ini
sed -i "s/user = www-data/user = ncanode/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/group = www-data/group = ncanode/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/pm = dynamic/pm = static/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/pm.max_children = 5/pm.max_children = ${PHP_PM_MAX_CHILDREN}/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/;pm.max_requests = 500/pm.max_requests = ${PHP_PM_MAX_REQUESTS}/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/listen.owner = www-data/listen.owner = ncanode/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/listen.group = www-data/listen.group = ncanode/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/;catch_workers_output = yes/catch_workers_output = yes/g" /etc/php/7.4/fpm/pool.d/www.conf

NCANODE_REMOTE_URL_SED=${NCANODE_REMOTE_URL//\//\\\/}
NCANODE_REMOTE_URL_SED=${NCANODE_REMOTE_URL_SED//\./\\\.}
NCANODE_KEY_SED=${NCANODE_KEY//\//\\\/}
NCANODE_KEY_SED=${NCANODE_KEY_SED//\./\\\.}
NCANODE_PWD_SED=${NCANODE_PWD//\//\\\/}
NCANODE_PWD_SED=${NCANODE_PWD_SED//\./\\\.}

if [ $DEV != 'true' ]; then
  sed -i "s/NCANODE_REMOTE_URL/$NCANODE_REMOTE_URL_SED/g" /opt/ncanode/src/Resource/config/resources_shared.php
  sed -i "s/\$this->addResources(__DIR__ \. '\/\.\.\/env\.php');//g" /opt/ncanode/src/Application.php
  sed -i "s/NCANODE_KEY/$NCANODE_KEY_SED/g" /opt/ncanode/src/Resource/config/resources_shared.php
  sed -i "s/NCANODE_PWD/$NCANODE_PWD_SED/g" /opt/ncanode/src/Resource/config/resources_shared.php
fi

if [ $DEV = 'true' ]; then
  set -x \
  && cd /opt/ncanode \
  && cp env.example.php env.php \
  && cp propel.example.php propel.php
fi

touch /node_status_inited
