![Docker Pulls](https://img.shields.io/docker/pulls/tommypria/peron)

# PHP Docker Starter

Use this project to start build an app using PHP & docker.

# Installation

1. Build image (if needed).
   ```bash
   docker build -f docker/files/php/8.0/Dockerfile.local . -t peron:php8-fpm
   ```
   Or, you can just pull the image from docker hub by execute this command
   ```bash
   docker pull tommypria/peron:php8-fpm
   ```
2. Copy env example files to real env files
   ```bash
   cp -r docker/config/local/compose/.env.example docker/config/local/compose/.env
   cp -r docker/config/local/compose/db.env.example docker/config/local/compose/db.env
   cp -r docker/config/local/compose/app.env.example docker/config/local/compose/app.env
   cp -r docker/config/local/compose/web.env.example docker/config/local/compose/web.env
   cp -r docker/config/local/compose/adminer.env.example docker/config/local/compose/adminer.env
   ```
3. Build the containers
   ```bash
   docker compose --file=./docker/config/local/compose/docker-compose.yml --env-file=./docker/config/local/compose/.env up -d
   ```
