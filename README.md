Основная логика согласно ТЗ опсиана в следующий файлах

```
src/Controller/UserPrizeController.php
src/Service/LotteryDrawingMachine.php
src/Command/UserPrizeActivationCommand.php
src/Service/MoneyToBonusesConverter.php
tests/Service/MoneyToBonusesConverterTest.php
```

## Как запустить проект

Не выносил весь запуск в Dockerfile потому что для установки может понадобится токен 
GitHub и интерактивная консоль.

```
docker-compose up -d
docker-compose exec lottery-php-fpm bash
```

#### Установка зависимостей
```
composer install
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

----

#### Запуск тестов

```
bin/phpunit
```
