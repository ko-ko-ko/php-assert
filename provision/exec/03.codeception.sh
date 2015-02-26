#!/bin/bash

CODECEPT_PATH="/usr/local/bin/codecept"

curl -s -L http://codeception.com/codecept.phar > $CODECEPT_PATH
chmod +x $CODECEPT_PATH
