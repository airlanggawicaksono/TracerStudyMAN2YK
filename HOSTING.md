# Hosting — Tracer Study MAN2YK

Plain PHP (mysqli) + MariaDB, containerized. No app rewrite. All config is
hardcoded in `docker-compose.yml` — no `.env` file.

## Stack
- `web` — php:8.2-apache, serves this folder (bind-mounted), `index.php` as entry. Bound to `127.0.0.1:6473`.
- `db`  — mariadb:10.4 (matches the `Database.sql` dump). Bound to `127.0.0.1:6474`. Data in named volume `dbdata`.
- `Database.sql` is auto-imported on the **first** boot only.

## Fixed config (in docker-compose.yml)
| Key | Value |
|-----|-------|
| Web URL (local) | http://localhost:6473 |
| DB host port | 6474 |
| DB name | db_alumni_tracer |
| DB user / pass | tracer_man2 / AlmTr4cer_MAN2_9kx |
| DB root pass | Root_MAN2_Alm_7pQ |

`koneksi.php` reads these from the container env (no `.env`); with no env it
falls back to localhost/root/empty so bare XAMPP still works.

## First run
```bash
make up        # build + start, http://localhost:6473
```

## Commands (`make help`)
| Command | What |
|---------|------|
| `make up` | build + start web + db |
| `make down` | stop |
| `make restart` | down then up |
| `make logs` | tail logs |
| `make db` | MySQL shell in the db container |
| `make web` | bash in the web container |
| `make import FILE=x.sql` | import a dump |
| `make export FILE=out.sql` | dump the database |
| `make reset` | **wipe** db volume + re-import `Database.sql` |

## nginx (alumni.man2yogyakarta.sch.id)
`alumni.conf` reverse-proxies the domain → `127.0.0.1:6473`.
```bash
sudo cp alumni.conf /etc/nginx/sites-available/alumni
sudo ln -s /etc/nginx/sites-available/alumni /etc/nginx/sites-enabled/alumni
sudo nginx -t && sudo systemctl reload nginx
```
DNS: A record `alumni.man2yogyakarta.sch.id` → server IP.

## Notes
- Change the web port? Edit it in `docker-compose.yml` AND `alumni.conf` (proxy_pass).
- Re-import after first boot: `make reset` (destroys current data) or `make import FILE=Database.sql`.
- Containers bind `127.0.0.1` only — not exposed to the internet, only nginx reaches them.
- No `make` on Windows? Run the `docker compose ...` lines from the Makefile directly.
