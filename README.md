Portus
======
Skeleton for develop web applications based on silex and doctrine at University of Seville

Installing
----------

Clone code at your develop workstation
```
$ git clone https://github.com/Universidad-de-Sevilla/portus.git portus
```

Init composer from Terminal: 
```
$ composer install
```

Copy config files
```
$ cp config/dev.sample.php config/dev.php
$ cp config/prod.sample.php config/prod.php
```

Create cache and logs directories (and set necessary privileges)
```
$ mkdir -p var/cache/profiler var/cache/twig var/logs var/private_uploads
```
 
Create **portus** database (mysql):

```
CREATE USER 'portus'@'localhost' IDENTIFIED BY 'a_very_very_very_STRONG_password';
GRANT ALL ON 'portus'.* TO 'portus'@'localhost';
REVOKE GRANT OPTION ON 'portus'.* FROM 'portus'@'localhost';
FLUSH PRIVILEGES;
```

Dump initials entities in database:
```
$ bin/console orm:schema-tool:update --force --dump-sql
```



Running
-------

To browse errors and debug run from your navigator with:
`http://localhost/portus/web/index_dev.php` or better `http://portus.dev/index_dev.php` 
(you need to configura a vhost in apache)



