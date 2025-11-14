FROM php:8.4-cli-alpine

COPY . /opt/generator
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# install dependencies for php modules
RUN set -e \
    && apk add git libzip libzip-dev \
    && docker-php-ext-install zip \
    && apk del libzip-dev

# set up php
RUN set -e \
    && mv /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini \
    && sed -i 's/^variables_order.*/variables_order=EGPCS/' /usr/local/etc/php/php.ini \
    && php -i \
    && php -m

# build project
RUN set -e \
    && export COMPOSER_ALLOW_SUPERUSER=1 \
    && composer diagnose || true \
    && rm -r -f /opt/generator/composer.lock /opt/generator/vendor \
    && composer update --working-dir=/opt/generator --ansi --no-dev --prefer-dist --optimize-autoloader --no-interaction \
    && rm -rf "$(composer config cache-dir --global)" "$(composer config data-dir --global)" "$(composer config home --global)"

ENTRYPOINT ["/usr/local/bin/php", "/opt/generator/bin/resources-sat-xml-generator"]
