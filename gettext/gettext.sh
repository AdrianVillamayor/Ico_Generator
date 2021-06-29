#!/bin/bash

clear
echo CLEAN UP
echo
rm -rf output/*
#php language.php
echo
echo Creating catalogs from templates and source code...
echo

project_id="ex"

langs="es_ES ca_ES fr_FR en_US"

for lang in $langs; do
    if [ -f ../locale/"$lang"/LC_MESSAGES/"$project_id".po ]; then
        echo "$lang" PO file exists, updating!
        find ../common ../Views ../Models ../Controllers ../Core ../ -name '*.php' | xargs xgettext --from-code UTF-8 -L php -p ../locale/"$lang"/LC_MESSAGES/ -o update.po
        msgmerge -U ../locale/"$lang"/LC_MESSAGES/"$project_id".po ../locale/"$lang"/LC_MESSAGES/update.po
        rm ../locale/"$lang"/LC_MESSAGES/update.po
    else
        find ../common ../Views ../Models ../Controllers ../Core ../ -name '*.php' | xargs xgettext --from-code UTF-8 -L php -p ../locale/"$lang"/LC_MESSAGES/ --default-domain="$project_id"
    fi
    echo Compiling new "$lang"
    msgfmt ../locale/"$lang"/LC_MESSAGES/"$project_id".po -o ../locale/"$lang"/LC_MESSAGES/"$project_id".mo
    echo

done
