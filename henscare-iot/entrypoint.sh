if [ ! -d "vendor" ]; then
  echo "Running composer install..."
  composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist
fi

chown -R www-data:www-data /var/www/html
chmod -R 775 storage bootstrap/cache

if [ ! -s ".env" ]; then
  cp .env.example .env
fi

if ! grep -q "^APP_KEY=base64" .env; then
  echo "Generating application key..."
  php artisan key:generate
fi

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

exec php-fpm
