#!/bin/bash
php artisan migrate:fresh --seed &&
ln -s /app/storage/app/public /app/public/storage