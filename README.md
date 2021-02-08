# Как запустить проект

```
docker-compose up -d
docker-compose exec lottery-php-fpm bash
```

# Инициализация БД (создание схемы)

```
bin/console doctrine:migrations:migrate
```

# Загрузить фикстуры

```
bin/console doctrine:migrations:migrate
```

