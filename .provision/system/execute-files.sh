#!/bin/bash

echo "Run scripts from /vagrant/.provision/exec/"

SCRIPT_LOG="/.provision-stuff/execute-files.txt"
TMP_ALL_PATH="/tmp/execute-files-all.txt"
TMP_EXECUTED_PATH="/tmp/execute-files-executed.txt"
FILES_PATH="/vagrant/.provision/exec/"
SPLIT="------------------------------------------------------------------"

if [[ ! -f $SCRIPT_LOG ]]; then
    touch $SCRIPT_LOG
fi

cat $SCRIPT_LOG > $TMP_EXECUTED_PATH

find $FILES_PATH -maxdepth 1 -not -path $FILES_PATH'.*' -type f \( ! -iname ".gitignore" \) | sort > $TMP_ALL_PATH

FILES_TO_RUN=( `comm -13  $SCRIPT_LOG $TMP_ALL_PATH` )

for file in "${FILES_TO_RUN[@]}"
do
    chmod +x $file
    echo $SPLIT
    echo "Exec: $file"
    /bin/bash $file
    echo "Finish: $file"
    echo $file >> $TMP_EXECUTED_PATH
done

cat $TMP_EXECUTED_PATH | sort > $SCRIPT_LOG

rm $TMP_ALL_PATH $TMP_EXECUTED_PATH

echo $SPLIT

