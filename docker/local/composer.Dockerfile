FROM php:8.2-fpm-alpine3.17

ARG UID
ARG GID

RUN addgroup -g ${UID} appgroup && \
    adduser -D -u ${GID} -G appgroup appuser

# Install dependencies for Redis extension
RUN apk add --no-cache pcre-dev autoconf $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis.so \
    && apk del pcre-dev $PHPIZE_DEPS

# Address potential dependencies for various extensions
RUN apk add --no-cache autoconf make g++ zlib-dev \
    && apk add --no-cache curl openssl-dev # Additional dependencies

# Install MySQL client (may be optional)
RUN apk add --no-cache mysql-client

# Install MySQL development package (retry on failure)
RUN apk add --no-cache mysql-dev || apk del mysql-client && apk add --no-cache mysql-dev

# Install PDO and PDO_MySQL extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install other extensions
RUN apk add --no-cache icu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && apk del icu-dev \
    && apk add --no-cache icu

RUN cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN curl -sS https://getcomposer.org/installer | php -- \
        --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www


CMD /bin/sh -c "composer install --no-interaction && php artisan migrate"