FROM php:7.4-fpm-alpine

RUN apk add --no-cache --update make gcc g++ \
    libc-dev \
    libzip-dev \
    zip \
    autoconf \
    && rm -rf /var/cache/apk/*

# - copy composer executable
COPY --from=composer /usr/bin/composer /usr/bin/

# - docker-php-ext-install
RUN docker-php-ext-install mysqli \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install zip

# - pecl install
RUN pecl install -o -f xdebug \
    && pecl install -o -f redis

# - enable extensions
RUN docker-php-ext-enable xdebug redis

# - php.ini files and configurations
ENV XDEBUG_INI_FILE=/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_port=10000" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.coverage_enable=0" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.remote_enable=1" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.remote_connect_back=1" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.remote_log=/tmp/xdebug.log" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.remote_autostart=true" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.remote_host=webserver" >> ${XDEBUG_INI_FILE}

RUN apk add tzdata \
    && cp /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime