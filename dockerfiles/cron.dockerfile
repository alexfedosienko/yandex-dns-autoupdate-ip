FROM php:8-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

# COPY crontab /etc/crontab/root
COPY crontab /var/spool/cron/crontabs/root

CMD ["crond", "-f"]