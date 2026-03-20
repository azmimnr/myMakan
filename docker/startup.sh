#!/bin/bash
# Runs on every container start via webdevops entrypoint.d
# 1) Ensures storage directory structure exists (Docker volume masks image dirs)
# 2) Creates /app/.env safely from container environment variables using PHP
# 3) Clears stale bootstrap cache

echo "[startup] Starting app init..."

# ---------------------------------------------------------------------------
# 1. Storage / bootstrap structure
# ---------------------------------------------------------------------------
echo "[startup] Creating storage directories..."
mkdir -p \
    /app/storage/app/public \
    /app/storage/framework/views \
    /app/storage/framework/cache/data \
    /app/storage/framework/sessions \
    /app/storage/logs \
    /app/bootstrap/cache

chown -R application:application /app/storage /app/bootstrap/cache
chmod -R 775 /app/storage /app/bootstrap/cache
echo "[startup] Storage directories OK."

# Ensure media-library directories exist and are writable.
mkdir -p /app/storage/app/public /app/storage/app/public/media
chown -R application:application /app/storage/app/public
chmod -R 775 /app/storage/app/public

# ---------------------------------------------------------------------------
# 2. Write .env using PHP (handles special characters in passwords safely)
# ---------------------------------------------------------------------------
echo "[startup] Writing .env..."
php /app/docker/write-env.php
echo "[startup] .env OK: $(wc -l < /app/.env) lines written."

# ---------------------------------------------------------------------------
# 3. Clear stale bootstrap cache so fresh env is always picked up
# ---------------------------------------------------------------------------
echo "[startup] Clearing bootstrap cache..."
rm -f /app/bootstrap/cache/config.php \
      /app/bootstrap/cache/routes*.php \
      /app/bootstrap/cache/services.php \
      /app/bootstrap/cache/packages.php

echo "[startup] Init complete."

# Ensure public storage symlink exists after each container start.
# In containerized deployments, this symlink can be lost across rebuild/redeploy.
if [ ! -L /app/public/storage ]; then
    rm -rf /app/public/storage
    ln -s /app/storage/app/public /app/public/storage
fi

echo "[startup] Storage link OK."
