*Сервисы для парсинга*
# Валюта: https://www.nbrb.by/services/xmlexratesref.aspx
# Курсы валют: https://www.nbrb.by/services/xmlexratesdyn.aspx?curId=431&fromdate=01/01/2022&todate=01/16/2022

При использовании курсов, по ТЗ необходимо было пользоватся именно сервисом с XML(http://nbrb.by/Services/XmlExRates.aspx ).
Данный сервис являеться устаревшим (написано на саой странице).
Если бы можно было пользоваться сервисом по средствам API - можно было решить проблемм:
- Полный перечень иностранных валют, по отношению к которым Национальным банком устанавливается официальный курс белорусского рубля:
   http://nbrb.by/Services/XmlExRates.aspx - данный сервис не работает с параметром **Periodicity**
- Данные по всем валютам брал отсюда: https://www.nbrb.by/services/xmlexratesref.aspx
  Но на многих актуальных валютах отсутствую курсы на конкретную дату.

Установка

 1. Клонируем репоситорий https://github.com/basked/exchange-rate.git
 2. cd exchange-rate 
 3. composer install 
 4. После установки зависимостей можно, поднять контейнеры Docker при помощи команды *./vendor/bin/sail up* .
    В данном приложении для работы с контейнерами использовался пакет Sail (см. https://laravel.com/docs/8.x/sail)
 5. Далее запускаем миграции командой *sail artisan migrate* либо *php artisan migrate*
 6. CLI для импорта данных: команда *sail artisan:import:ExchRates* либо *php artisan:import:ExchRates*. При этом происходит импорт данных в БД.
 7. Страница вывода курсов валют за последнюю неделю: корневой URL: http://localhost/ 
 8. API для экспорта данных в JSON формате: http://localhost/api/exchanges 