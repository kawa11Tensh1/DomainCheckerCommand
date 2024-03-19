# Устанавливаем базовый образ
FROM php:8.3-cli

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash

# Копируем все файлы вашего приложения в рабочую директорию контейнера
COPY . /app

# Переходим в рабочий каталог приложения
WORKDIR /app

# Определяем команду для запуска Symfony приложения с передачей доменного имени через переменную окружения
CMD ["sh", "-c", "php bin/console domain:check $DOMAIN_NAME"]