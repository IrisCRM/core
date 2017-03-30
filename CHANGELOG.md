<a name="5.0.0"></a>
# 5.0.0 (2017-03-28)

### Основные изменения
* Встроен менеджер пакетов [Composer](https://getcomposer.org/)
* Веб сервер теперь должен быть сконфигурирован таким образом, чтобы корневым каталогом являлся каталог `public`
* Ядро вынесено в отдельный репозиторий
* Стандартная CRM конфигурация вынесена в отдельный репозиторий
* Теперь отраслевые решения должны вестись в отдельных неймспейсах и в отдельных репозиториях
* Пользовательские настройки теперь должны вестись в отдельных неймспейсах
* Сборка статики организована с помощью [Gulp](http://gulpjs.com/)
* Подключение классов конфигурации организовано с помощью неймспейсов
* Внедрен механизм миграций, пакет [doctrine/migrations](https://github.com/doctrine/migrations)
* Добавлен механизм консольных команд, пакет [symfony/console](https://github.com/symfony/console)
* Добавлена консольная утилита `iris`
* С объектами теперь можно работать через сервис-контейнер, в систему встроен компонент [Dependency Injection](https://github.com/symfony/dependency-injection), классы можно регистрировать в сервис-провайдере 
* [Логирование сообщений](https://github.com/IrisCRM/iriscrm-project/tree/master/docs/guides/ru/logger.md) реализовано через [Monolog](https://github.com/Seldaek/monolog)
* Добавлена интеграция с системой мониторинга ошибок [Sentry](https://sentry.io)
* Добавлена возможность переопределять переводы в конфигурации
* Добавлена возможность переопределять темы оформления в конфигурации
* Добавлена возможность [переопределять страницу логина](https://github.com/IrisCRM/iriscrm-project/tree/master/docs/guides/ru/login-form.md) в конфигурации
* Добавлена возможность управления [окружениями](https://github.com/IrisCRM/iriscrm-project/tree/master/docs/guides/ru/environments.md)
* Обновление системы теперь [выполняется из консоли](https://github.com/IrisCRM/iriscrm-project/tree/master/docs/guides/ru/update.md)
* В качестве фреймворка для тестирования используется [Codeception](http://codeception.com/)
