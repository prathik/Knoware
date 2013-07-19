KnoWare
=======

Knowledge Manangement and Tracking Software.

Vision note for contributors
----------------------------

KnoWare is a tool that "improves society by enabling people to think better". All features of KnoWare should fall under that goal.

KnoWare promotes the scientific method where a concept has to be extensively experimented with and tested before it is accepted.

This tool is built for a cause and so it will remain open source and not-for-profit. See the license section for more details.

ToDo
----

- [] Build the review workflow.
- []  Send reminders to users via email if they have to review.
- []  Implement public/private ideas.
- [x] Enable commenting on private ideas. (priority)
- [] Enable commenting on public ideas.

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

License
-------

Released under GPL 3 with little modification mentioned below.

Link to GPL 3: http://www.gnu.org/licenses/gpl.html

Additional Terms:

* Users should never be charged to use KnoWare.
* Money can be raised only via donation by people and these donations should be made by the will of people and no extra benefits or service can be given for these donations.
* Private data of the users including their email, username or thesis (also called ideas) cannot be sold or shared without prior permission from the said user and the permission has to be acceptable by the local (with respect to the user) law authorities.
* Names of the original author(s) should always be mentioned in any distribution.
