#!/bin/bash
ln -s /app/storage/app/public /app/public/storage &&
php artisan migrate:fresh --seed