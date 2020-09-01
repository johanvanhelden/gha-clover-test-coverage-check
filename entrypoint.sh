#!/usr/bin/env bash
fileName=$1
minPercentage=$2

php /test-coverage-checker.php $fileName $minPercentage
if [ $? != 0 ]; then
    exit 1;
fi