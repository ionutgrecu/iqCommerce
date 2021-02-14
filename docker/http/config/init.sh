#!/bin/sh

cd "$(dirname "$0")"

#if [ -f /var/www/html/crontab ]; then
#    /usr/bin/crontab /var/www/html/crontab
#fi

#cron -f -L 15 &
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
