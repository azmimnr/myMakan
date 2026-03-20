# External Deployment: Portainer + Nginx Proxy Manager

This deployment keeps the application code on the Docker host and uses Portainer to run the stack.

## 1. Host preparation

On the Docker host, place the project at:

`/opt/mymakan`

Required files on the host path:

- application source code
- `docker-compose.portainer.yml`
- `.env`

Copy the production environment template:

- copy `.env.production.example` to `.env`
- review SMTP values
- confirm `APP_URL=https://mymakan.mydigitalservice.net`
- keep `DB_HOST=db`

## 2. Create Docker network for Nginx Proxy Manager

Create a shared external network once on the Docker host:

```bash
docker network create proxy
```

Your Nginx Proxy Manager stack must also be attached to the same `proxy` network.

## 3. Deploy in Portainer

Use the stack file:

- `docker-compose.portainer.yml`

Set the stack environment variable in Portainer:

```text
APP_PATH=/opt/mymakan
```

Deploy the stack.

## 4. One-time app initialization

After the stack is running, open the app container console in Portainer and run:

```bash
chown -R application:application /app/storage /app/bootstrap/cache
chmod -R 775 /app/storage /app/bootstrap/cache
php artisan storage:link
php artisan optimize:clear
```

## 5. Fresh install or existing data

### Option A: Fresh production install

Open:

- `https://mymakan.mydigitalservice.net/install`

Then complete the installer using:

- database host: `db`
- database port: `3306`
- database name: `mymakan`
- database username: `mymakan_user`
- database password: `dbpassword$$%%`

### Option B: Move the tested local database

Export from local:

```bash
docker compose -f docker-compose.local.yml exec -T db mysqldump -umymakan_user -p'dbpassword$$%%' mymakan > mymakan.sql
```

Import on the host into the `db` container:

```bash
docker exec -i mymakan_db mysql -umymakan_user -p'dbpassword$$%%' mymakan < mymakan.sql
```

If you import the local database, do not run the installer again.

## 6. Nginx Proxy Manager setup

Create a new Proxy Host in Nginx Proxy Manager:

- Domain Names: `mymakan.mydigitalservice.net`
- Scheme: `http`
- Forward Hostname / IP: `mymakan_app`
- Forward Port: `80`
- Websockets Support: enabled
- Block Common Exploits: enabled
- Cache Assets: optional

SSL tab:

- Request a new Let's Encrypt certificate
- Force SSL: enabled
- HTTP/2 Support: enabled
- HSTS: enabled if you want strict HTTPS

Advanced tab recommended snippet:

```nginx
client_max_body_size 64m;
proxy_read_timeout 300s;
proxy_send_timeout 300s;
proxy_connect_timeout 60s;
```

## 7. Post-deploy checks

Verify these after the first successful load:

- login works
- dashboard loads
- media upload works
- `public/storage` files are served correctly
- SMTP test mail works
- background features that depend on app settings work as expected

## 8. Upgrades

For future upgrades:

1. back up the database volume first
2. back up `/opt/mymakan/storage`
3. update project files in `/opt/mymakan`
4. redeploy the Portainer stack
5. run `php artisan optimize:clear`

## 9. Important note

This stack intentionally does not publish the app port to the public internet. External access should go only through Nginx Proxy Manager on the shared `proxy` network.
