FROM php:7.4-alpine

LABEL "com.github.actions.name"="clover-coverage-check"
LABEL "com.github.actions.description"="A clover coverage checker"
LABEL "com.github.actions.icon"="check"
LABEL "com.github.actions.color"="green"

LABEL "repository"="https://github.com/johanvanhelden/clover-coverage-check"
LABEL "homepage"="http://github.com/actions"

RUN apk update && apk add bash

COPY test-coverage-checker.php /test-coverage-checker.php
COPY entrypoint.sh /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
