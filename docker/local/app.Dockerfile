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

# Install Xdebug with additional dependencies
RUN apk add --no-cache $PHPIZE_DEPS linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del $PHPIZE_DEPS

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

# Install GD extension
RUN apk add --no-cache freetype-dev libjpeg-turbo-dev libpng-dev libwebp-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd

RUN cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN curl -sS https://getcomposer.org/installer | php -- \
        --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

# Set ownership of /var/www to the created user
RUN chown -R appuser:appgroup /var/www