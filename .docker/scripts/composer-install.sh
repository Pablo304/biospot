#!/usr/bin/env bash
source $(dirname "$0")/_vars.sh
options=(`docker container ls --filter "label=php" --format "{{.Names}}"`)
echo -e $RED_COLOR"Composer Install..."$RESET_COLOR
docker compose -f ./docker-compose.yml exec php-fpm composer install --no-interaction
