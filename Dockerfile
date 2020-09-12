FROM php:7.4-alpine

RUN apk update && apk add bash

COPY src /src
COPY entrypoint.sh /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
