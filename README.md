# Проект по инфобезу

## Описание проекта
Данное консольное PHP-приложение на фреймворке Symfony предназначено для проверки существования и регистрации домена, получения IP-адреса (тип DNS-записи «A»), чтения DNS-записей с типом MX для получения списка серверов обработки почты, извлечения IP-адресов почтовых серверов и запроса PTR-записей.

## Установка и запуск
1.	Клонировать репозиторий с проектом с GitHub.
2.	Установить **Docker** и **Docker-compose**, если они не установлены.
3.	В терминале выполнить команду `docker-compose build` для сборки контейнера.
4.	Запустить приложение с помощью команды `docker-compose run --rm -e DOMAIN_NAME=vl.ru php_app`. **Примечание:** доменное имя можно заменить на любое другое.

## Пример вывода
После выполнения команды `php bin/console domain:check vl.ru` результат будет следующим:
```
IP-адрес домена vl.ru: 195.88.225.208
Почтовый сервер: mx.vl.ru, IP-адрес: 195.88.225.143, PTR-запись: m.vl.ru
Почтовый сервер: mx.vl.ru, IP-адрес: 195.88.225.144, PTR-запись: m.vl.ru
```

## Бонус
Проект упакован в **Docker-compose** для удобного развёртывания и использования.

## Репозиторий проекта
Проект доступен на GitHub по [ссылке](https://github.com/kawa11Tensh1/DomainCheckerCommand.git).