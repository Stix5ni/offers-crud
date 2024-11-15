# Тестовое задание для Middle FullStack разработчика


## Требования

   - PHP 7 и выше
   - Composer
   - Docker
   - Docker Compose

## Установка

   1. Клонируйте репозиторий

   2. Установите зависимости Composer

   3. Создайте файл .env в корневом каталоге проекта и добавьте необходимые переменные

   4. Запустите контейнеры с помощью Docker Compose

   5. Выполните миграции базы данных (docker-compose exec app php yii migrate/php yii migrate)

## Переменные окружения

В файле `.env` должны быть следующие переменные:

```plaintext
DB_USERNAME=ваше имя (root по стандарту)
DB_PASSWORD=ваш_пароль
DB_DATABASE=ваша база данных
```

## Структура проекта

    config/ — конфигурация приложения.
    controllers/ — контроллеры, управляющие логикой API.
    models/ — модели, представляющие сущности базы данных.
    migrations/ — миграции для создания и изменения структуры базы данных.
        migrations_offer.sql — SQL-скрипт для создания таблицы offers и заполнения ее 10-15 тестовыми записями. 
    views/                   # Папка для представлений
        offer/               # Представления для работы с офферами (контроллер 'OfferController')
            index.php        # Шаблон для отображения списка офферов
            create.php       # Шаблон для создания нового оффера
            update.php       # Шаблон для редактирования оффера
            view.php         # Шаблон для отображения подробной информации об оффере
    docker-compose.yml — файл конфигурации Docker Compose.
    Dockerfile — файл для сборки контейнера приложения.
    .env — файл с переменными окружения (пароли и другие конфигурации).

## Технологии

   - JS
   - PHP
   - Yii2
   - Docker
   - MySQL
