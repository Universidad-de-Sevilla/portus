Portus
======
Skeleton for develop web applications based on silex and doctrine at University of Seville

Installing
----------

1. Clone code at your develop workstation

2. Run composer install
 
3. Create **portus** database (mysql)
    CREATE USER 'portus'@'localhost' IDENTIFIED BY 'a_very_very_very_STRONG_password';
    GRANT ALL ON 'portus'.* TO 'portus'@'localhost';
    REVOKE GRANT OPTION ON 'portus'.* FROM 'portus'@'localhost';
    FLUSH PRIVILEGES;

4. Dump initials entities in database
    $ bin/console orm:schema-tool:update --force --dump-sql



