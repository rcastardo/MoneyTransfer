FROM nginx:1.15-alpine
WORKDIR /etc/nginx/conf.d
COPY nginx.conf /etc/nginx/
RUN apk update \
    && adduser -D -H -u 1000 -s /bin/bash www-data