#!/bin/bash
set -e

composer install --no-dev --optimize-autoloader
php artisan storage:link || true
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true