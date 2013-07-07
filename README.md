KnoWare
=======

Knowledge Manangement and Tracking Software.

Requirements
------------

* Apache httpd Server with module rewrite enabled.
* Mysql 5.5+
* PHP 5.3+

Configuration
-------------

Save server/config.php.sample as server/config.php, `cp server/config.php.sample server/config.php`.

Open config.php and set your mysql username, password and database name.

Open server/config.php and set your **SALT**. This is a very important step! Not doing this leads to a high security risk!

Installation
------------

Run server/install.php from your browser.
