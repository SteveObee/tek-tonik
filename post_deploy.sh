#!/bin/bash
php artisan migrate:fresh --seed &&
php artisan storage:link
