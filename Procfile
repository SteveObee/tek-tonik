web: vendor/bin/heroku-php-nginx -C tek-tonik.conf public/
release: php artisan migrate:fresh --seed &&
         rm public/storage &&
         php artisan storage:link