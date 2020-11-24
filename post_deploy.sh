#!/bin/bash
php artisan migrate:fresh --seed &&
php artisan optimize &&
php artisan storage:link
