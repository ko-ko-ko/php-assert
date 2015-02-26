#!/bin/sh

apt-get update > /dev/null 2>&1

apt-get install -y vim mc htop \
    git mercurial \
    curl \
    php-pear php5-dev php5-cli php5-curl php5-xdebug > /dev/null 2>&1

