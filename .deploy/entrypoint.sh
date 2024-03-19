#!/bin/sh

echo "🎬 entrypoint.sh: [$(whoami)] [PHP $(php -r 'echo phpversion();')]"

composer dump-autoload --no-interaction --no-dev --optimize

echo "🎬 artisan commands"

# 💡 Group into a custom command e.g. php artisan app:on-deploy
php artisan migrate --no-interaction --force

php artisan storage:link

php artisan view:cache

echo "🎬 start supervisord"

#    echo "Starting services..."
# service php8.2-fpm start
# nginx -g "daemon off;" &
# echo "Ready."
# tail -s 1 /var/log/nginx/*.log -f

supervisord -c $LARAVEL_PATH/.deploy/config/supervisor.conf
