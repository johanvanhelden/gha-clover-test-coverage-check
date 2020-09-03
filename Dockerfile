FROM php:7.4-alpine

RUN apk update && apk add bash

COPY test-coverage-checker.php /test-coverage-checker.php
COPY entrypoint.sh /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
