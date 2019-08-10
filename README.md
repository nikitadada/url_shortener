url_shorter
===========

A Symfony project created on August 10, 2019, 12:07 pm.


Развертывание проекта
1. git clone https://github.com/nikitadada/url_shortener.git
2. composer config "platform.ext-mongo" "1.6.16" && composer require alcaeus/mongo-php-adapter
Должна быть установлена mongodb 3.4 или выше и php extension для нее. В команде также ставится адаптер для запуска на php7 mongodb v3. С mongodb v4 можно выполнить просто composer install.
