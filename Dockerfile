FROM composer:2 AS vendor_builder

WORKDIR /app

COPY composer.json composer.lock ./

# Install PHP dependencies without running app scripts during build.
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --optimize-autoloader \
    --ignore-platform-reqs

FROM webdevops/php-nginx:8.2

WORKDIR /app

COPY . /app
COPY --from=vendor_builder /app/vendor /app/vendor

# Install startup init script (runs via webdevops entrypoint.d on every container start).
# It creates storage directory structure, writes .env from env vars, and clears stale cache.
COPY docker/startup.sh /opt/docker/provision/entrypoint.d/10-app-init.sh
RUN chmod +x /opt/docker/provision/entrypoint.d/10-app-init.sh

ENV WEB_DOCUMENT_ROOT=/app/public
ENV PHP_DISPLAY_ERRORS=0
ENV PHP_MEMORY_LIMIT=512M
ENV PHP_POST_MAX_SIZE=64M
ENV PHP_UPLOAD_MAX_FILESIZE=64M
