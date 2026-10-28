# Регистрация пользователя

Установить зависимости и создать таблицу:

```bash
composer install
php bin/console doctrine:schema:update --force
php -S 127.0.0.1:8000 -t public
```

Откройте `http://127.0.0.1:8000/`.
