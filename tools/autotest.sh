#!/usr/bin/env bash

cd /home/www/app/

rm -rf bootstrap/cache/*.php
php composer.phar dump-autoload
php /home/www/app/artisan config:clear
php /home/www/app/artisan cache:clear
TRY_COUNT=0
until (php /home/www/app/tools/check_db_status.php db user secret pearpop); do
    if [[ $(( TRY_COUNT++ )) -eq 30 ]]; then
        exit 1
    fi
    sleep 1
done

php /home/www/app/artisan migrate
php /home/www/app/vendor/bin/phpunit || exit 1
