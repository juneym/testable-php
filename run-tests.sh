#!/bin/sh

CWD=$(dirname $0)
echo $CWD

${CWD}/vendor/bin/phpunit ${CWD}/src/tests/
