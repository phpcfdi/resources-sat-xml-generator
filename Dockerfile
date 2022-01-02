FROM php:8.0-cli

COPY . /opt/generator

# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN set -e && \
    apt-get update && \
    apt-get install -y --no-install-recommends git zip unzip libzip-dev && \
    apt-get clean -y && \
    rm -rf /var/lib/apt/lists/*

RUN set -e && \
    php -i && \
    php -m && \
    docker-php-ext-install zip

RUN set -e && \
    curl -o /usr/bin/composer https://getcomposer.org/download/latest-stable/composer.phar && \
    chmod +x /usr/bin/composer && \
    /usr/bin/composer diagnose || true

RUN set -e && \
    cd /opt/generator && \
    export COMPOSER_ALLOW_SUPERUSER=1 && \
    composer install --ansi --no-dev --no-cache --prefer-dist --no-progress --no-interaction

ENTRYPOINT ["php", "/opt/generator/bin/resources-sat-xml-generator"]
