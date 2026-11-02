#!/usr/bin/env bash
# Perbarui website setelah kode berubah. Jalankan di mini PC:  cd /var/www/unik && ./deploy/update.sh
set -euo pipefail
cd "$(dirname "$0")/.."
A="docker compose exec -T -u www-data app"

$A php artisan down --retry=60 || true
# git pull --ff-only                       # aktifkan kalau memakai Git
$A composer install --no-dev --optimize-autoloader --no-interaction
$A php artisan migrate --force
$A php artisan storage:link 2>/dev/null || true
$A php artisan optimize:clear
$A php artisan optimize
$A php artisan up
echo "Selesai."
