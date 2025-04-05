#!/bin/sh


php artisan optimize:clear
php artisan migrate --force
php artisan storage:link
php artisan optimize

# Start Apache in the foreground
apache2-foreground
