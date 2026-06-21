# Tracer Study MAN2YK — dev / hosting commands.
# Usage: make <target>   (needs Docker + Docker Compose v2)
COMPOSE := docker compose
DB_NAME := db_alumni_tracer
DB_USER := tracer_man2
DB_PASS := AlmTr4cer_MAN2_9kx
FILE    ?= Database.sql

.PHONY: help up down restart rebuild logs ps db web import export reset

help:
	@echo "make up       - build + start web + db (background)"
	@echo "make down     - stop containers"
	@echo "make restart  - down then up"
	@echo "make rebuild  - rebuild image (no cache) then up"
	@echo "make logs     - tail all logs"
	@echo "make ps       - container status"
	@echo "make db       - MySQL shell inside the db container"
	@echo "make web      - bash inside the web container"
	@echo "make import FILE=x.sql  - import a .sql into the database"
	@echo "make export FILE=out.sql - dump the database to a file"
	@echo "make reset    - WIPE db volume + re-import Database.sql"

up:
	$(COMPOSE) up -d --build
	@echo "Tracer up -> http://localhost:6473"

down:
	$(COMPOSE) down

restart: down up

rebuild:
	$(COMPOSE) build --no-cache
	$(COMPOSE) up -d

logs:
	$(COMPOSE) logs -f

ps:
	$(COMPOSE) ps

db:
	$(COMPOSE) exec db mysql -u$(DB_USER) -p$(DB_PASS) $(DB_NAME)

web:
	$(COMPOSE) exec web bash

import:
	$(COMPOSE) exec -T db mysql -u$(DB_USER) -p$(DB_PASS) $(DB_NAME) < $(FILE)

export:
	$(COMPOSE) exec -T db mysqldump --single-transaction -u$(DB_USER) -p$(DB_PASS) $(DB_NAME) > $(FILE)

reset:
	$(COMPOSE) down -v
	$(COMPOSE) up -d --build
