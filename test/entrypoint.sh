#!/bin/sh
set -e
cd /var/www/flarum
if [ ! -f config.php ]; then
  until php -r 'new PDO("mysql:host=db;dbname=flarum", "flarum", "flarum");' 2>/dev/null; do sleep 2; done
  php flarum install --file=/test/install.yml
  composer config repositories.privatus '{"type":"path","url":"/ext","options":{"symlink":false}}'
  composer require privatus/flarum-privatus-analytics:@dev --no-interaction
  chown -R www-data:www-data /var/www/flarum
fi
exec apache2-foreground
