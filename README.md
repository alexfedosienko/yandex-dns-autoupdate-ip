# YandexDNS autoupdate IP

Автоматическое обновление внешнего IP адреса для доменов сервера

- `docker-compose run --rm composer install`
- `cp .evn.example .env`
- `docker-compose run --rm artisan key:generate`
- `docker-compose run --rm artisan migrate`
- `docker-compose run --rm artisan YandexUpdateIp`

http://ip-address:9090
