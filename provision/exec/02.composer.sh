#!/bin/bash

COMPOSER_PATH="/usr/local/bin/composer"

curl -s -L https://getcomposer.org/composer.phar > $COMPOSER_PATH
chmod +x $COMPOSER_PATH
