#!/bin/sh

CWD=$(dirname $0)
echo $CWD

${CWD}/vendor/bin/phpunit -c ${CWD}/src/tests/config.xml
