#!/bin/bash
php artisan migrate:fresh --seed &&
ln -s /app/public/storage /app/storage/app/public