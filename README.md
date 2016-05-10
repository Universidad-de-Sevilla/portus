Portus
======
Skeleton for develop web applications based on silex and doctrine at University of Seville

Installing
----------

Clone code at your develop workstation
```
git clone https://github.com/Universidad-de-Sevilla/portus.git portus
```

Init composer from Terminal: 
```
$ composer install
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


