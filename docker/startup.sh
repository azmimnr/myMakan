#!/bin/bash
# Runs on every container start via webdevops entrypoint.d
# 1) Ensures storage directory structure exists (Docker volume masks image dirs)
# 2) Creates /app/.env from container environment variables

set -e

# ---------------------------------------------------------------------------
# 1. Storage / bootstrap structure
# ---------------------------------------------------------------------------
mkdir -p \
    /app/storage/app/public \
    /app/storage/framework/views \
    /app/storage/framework/cache/data \
    /app/storage/framework/sessions \
    /app/storage/logs \
    /app/bootstrap/cache

chown -R application:application /app/storage /app/bootstrap/cache
chmod -R 775 /app/storage /app/bootstrap/cache

# ---------------------------------------------------------------------------
# 2. Generate .env from container env vars (required for installer + artisan)
# ---------------------------------------------------------------------------
cat > /app/.env <<ENVEOF
APP_NAME='${APP_NAME:-myMakan}'
APP_ENV=${APP_ENV:-production}
APP_KEY=${APP_KEY}
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-http://localhost}

LOG_CHANNEL=${LOG_CHANNEL:-stack}
LOG_LEVEL=${LOG_LEVEL:-warning}

DB_CONNECTION=${DB_CONNECTION:-mysql}
DB_HOST=${DB_HOST:-db}
DB_PORT=${DB_PORT:-3306}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD='${DB_PASSWORD}'

CACHE_DRIVER=${CACHE_DRIVER:-file}
CACHE_STORE=${CACHE_STORE:-file}
SESSION_DRIVER=${SESSION_DRIVER:-file}
QUEUE_CONNECTION=${QUEUE_CONNECTION:-sync}

TIMEZONE=${TIMEZONE:-UTC}

MAIL_MAILER=${MAIL_MAILER:-smtp}
MAIL_HOST=${MAIL_HOST}
MAIL_PORT=${MAIL_PORT:-587}
MAIL_USERNAME=${MAIL_USERNAME}
MAIL_PASSWORD='${MAIL_PASSWORD}'
MAIL_ENCRYPTION=${MAIL_ENCRYPTION:-tls}
MAIL_FROM_ADDRESS=${MAIL_FROM_ADDRESS}
MAIL_FROM_NAME='${MAIL_FROM_NAME}'
MAIL_EHLO_DOMAIN=${MAIL_EHLO_DOMAIN}

DEMO=${DEMO:-false}
MIX_API_KEY=${MIX_API_KEY}
VITE_API_KEY=${VITE_API_KEY}

CURRENCY=${CURRENCY:-USD}
CURRENCY_SYMBOL='${CURRENCY_SYMBOL:-$}'
CURRENCY_POSITION=${CURRENCY_POSITION:-5}
CURRENCY_DECIMAL_POINT=${CURRENCY_DECIMAL_POINT:-2}
DATE_FORMAT=${DATE_FORMAT:-d-m-Y}
TIME_FORMAT='${TIME_FORMAT:-h:i A}'
ENVEOF

chown application:application /app/.env
chmod 640 /app/.env

# ---------------------------------------------------------------------------
# 3. Clear stale bootstrap cache so fresh env is always picked up
# ---------------------------------------------------------------------------
rm -f /app/bootstrap/cache/config.php \
      /app/bootstrap/cache/routes*.php \
      /app/bootstrap/cache/services.php \
      /app/bootstrap/cache/packages.php

echo "[startup] Init complete."
