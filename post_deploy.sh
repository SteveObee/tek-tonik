#!/bin/bash
php artisan migrate:fresh --seed &&
rm public/storage &&
php artisan storage:link