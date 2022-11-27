FROM php:8.1-alpine

RUN apk update && apk add bash

COPY src /src
COPY entrypoint.sh /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
