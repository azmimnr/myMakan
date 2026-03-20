FROM webdevops/php-nginx:8.2

WORKDIR /app

COPY . /app

# Keep runtime directories writable for php-fpm user in container.
RUN chown -R application:application /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage /app/bootstrap/cache

ENV WEB_DOCUMENT_ROOT=/app/public
ENV PHP_DISPLAY_ERRORS=0
ENV PHP_MEMORY_LIMIT=512M
ENV PHP_POST_MAX_SIZE=64M
ENV PHP_UPLOAD_MAX_FILESIZE=64M
