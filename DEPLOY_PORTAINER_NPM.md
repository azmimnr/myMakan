# External Deployment: Portainer + Nginx Proxy Manager (Image-Based)

This deployment pulls your app image from GHCR and does not require `git clone` on the host.

## 1. Build and publish the app image

The repository includes a GitHub Actions workflow that builds and pushes:

- `ghcr.io/azmimnr/mymakan:latest`
- `ghcr.io/azmimnr/mymakan:<commit-sha>`

Workflow file:

- `.github/workflows/build-image.yml`

Push to `main` once and wait for Actions to complete successfully.

## 2. Host preparation

Create the shared Nginx Proxy Manager network once:

```bash
docker network create proxy
```

Make sure your Nginx Proxy Manager stack is attached to this same `proxy` network.

## 3. Deploy stack in Portainer

Create a stack using:

- `docker-compose.portainer.yml`

In Portainer stack environment variables, add values from `.env.production.example`.

Minimum required values:

- `MYMAKAN_IMAGE=ghcr.io/azmimnr/mymakan:latest`
- `APP_NAME`
- `APP_ENV`
- `APP_DEBUG`
- `APP_URL`
- `APP_KEY`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`
- `DB_ROOT_PASSWORD`
- `MAIL_HOST`
- `MAIL_PORT`
- `MAIL_USERNAME`
- `MAIL_PASSWORD`
- `MAIL_ENCRYPTION`
- `MAIL_FROM_ADDRESS`
- `MAIL_FROM_NAME`
- `VITE_API_KEY`

Then deploy the stack.

## 4. One-time app initialization

After containers are running, open app container console and run:

```bash
chown -R application:application /app/storage /app/bootstrap/cache
chmod -R 775 /app/storage /app/bootstrap/cache
php artisan storage:link
php artisan optimize:clear
```

## 5. Data initialization options

### Option A: Fresh production install

Open:

- `https://mymakan.mydigitalservice.net/install`

Use:

- host: `db`
- port: `3306`
- database: value of `DB_DATABASE`
- username: value of `DB_USERNAME`
- password: value of `DB_PASSWORD`

### Option B: Use tested local database

Export local DB:

```bash
docker compose -f docker-compose.local.yml exec -T db mysqldump -umymakan_user -p'dbpassword$$%%' mymakan > mymakan.sql
```

Import to production DB container:

```bash
docker exec -i mymakan_db mysql -u<DB_USERNAME> -p'<DB_PASSWORD>' <DB_DATABASE> < mymakan.sql
```

If importing existing data, do not run installer again.

## 6. Nginx Proxy Manager setup

Create Proxy Host:

- Domain: `mymakan.mydigitalservice.net`
- Scheme: `http`
- Forward Hostname/IP: `mymakan_app`
- Forward Port: `80`
- Websockets: enabled
- Block Common Exploits: enabled

SSL tab:

- Request Let's Encrypt certificate
- Force SSL: enabled
- HTTP/2: enabled

Advanced snippet:

```nginx
client_max_body_size 64m;
proxy_read_timeout 300s;
proxy_send_timeout 300s;
proxy_connect_timeout 60s;
```

## 7. Upgrade process

1. Push code changes to `main`.
2. Wait for GitHub Actions image build/push.
3. In Portainer, redeploy stack.
4. Run `php artisan optimize:clear` in app container.

## 8. Notes

- App container is not publicly exposed by port.
- Public traffic should pass only through Nginx Proxy Manager over `proxy` network.
- Uploaded files and runtime data persist in Docker volume `mymakan_storage`.
