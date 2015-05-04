#!/bin/bash

echo "Init"

if [[ ! -d '/.provision-stuff' ]]; then
    mkdir '/.provision-stuff'
    echo 'Created directory /.provision-stuff'
fi

bash /vagrant/.provision/system/execute-files.sh
bash /vagrant/.provision/system/dot-files.sh

clear
