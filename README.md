url_shorter
===========

A Symfony project created on August 10, 2019, 12:07 pm.


Развертывание проекта
1. git clone https://github.com/nikitadada/url_shortener.git
2. composer config "platform.ext-mongo" "1.6.16" && composer require alcaeus/mongo-php-adapter
* Должна быть установлена mongodb 3.4 или выше и php extension для нее. В команде также ставится адаптер для запуска на php7 mongodb v3. С mongodb v4 можно выполнить просто composer install.

Для определения браузера (на странице статистики) используется функция php get_browser. Для ее работы необходимо:
* wget http://browscap.org/stream?q=Lite_PHP_BrowsCapINI -O /etc/php/browscap.ini
***
И добавить в php.ini:

* [browscap]
* browscap = "/etc/php/browscap.ini"
***
Подробнее https://www.php.net/manual/ru/function.get-browser.php
***
Если этого не сделать, то в информацию о браузере будет записываться $_SERVER['HTTP_USER_AGENT']
<h3>Тесты</h2>
Для запуска тестов выполнить:
* ./vendor/bin/simple-phpunit

<h3>Описание</h3>
Для формирования кода короткой ссылки (alias в проекте) используется биективная функция, что позволяет однозначно отображать id в буквенно-цифровой код и выполнять обратное преобразование. Поэтому первые короткие ссылки будут иметь короткий односимвольный alias. Так, например id = 0 соответствует alias = A, id = 62 соответствует alias = BA. Всего односимвольных кодов 62, т.к. алфавит для генерации содержит 62 символа (буквы верхнего и нижнего регистров и цифры). 
*** 
Подробнее https://ru.wikipedia.org/wiki/%D0%91%D0%B8%D0%B5%D0%BA%D1%86%D0%B8%D1%8F 
***
При сохранении одинаковых длинных ссылок будет генерироваться разная короткая ссылка. 
* Во-первых, для одной и той же длинной ссылки пользователи (разные) могут указать разное время жизни или не указать, и это должны быть разные ссылки.
* Во-вторых, учитывая огромное количество возможных комбинаций коротких кодов, мы можем себе позволить использовать новый код.
* В-третьих, создать новую запись будет быстрее. Да, тут можно оптимизировать этот момент, находить длинную ссылку в базе, сравнивать время жизни и возвращать ту же или генерировать новую. В рамках данного задания я решил выбрать вариант проще.