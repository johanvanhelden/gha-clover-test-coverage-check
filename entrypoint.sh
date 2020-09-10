#!/usr/bin/env bash
fileName=$1
percentage=$2
precision=$3
exit=$4

php /src/test-coverage-checker.php $fileName $percentage $precision $exit

if [ $? != 0 ]; then
    exit 1;
fi
