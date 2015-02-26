#!/bin/sh

apt-get update > /dev/null 2>&1

apt-get install -y vim mc htop \
    git mercurial \
    php-pear php5-dev php5-cli > /dev/null 2>&1

