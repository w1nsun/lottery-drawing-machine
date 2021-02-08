#### Как запустить проект

```
docker-compose up -d
docker-compose exec lottery-php-fpm bash
```

#### Инициализация БД (создание схемы)

```
bin/console doctrine:migrations:migrate
```

#### Загрузить фикстуры

```
bin/console doctrine:migrations:migrate
```

#### Добавить возможность писать в БД для www-data (хак, не было времени заморачиватся)

```
chmod -R 777 var/data.db
```

