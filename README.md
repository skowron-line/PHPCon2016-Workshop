# PHPCon2016

### installation
```
$ git clone git@github.com:skowron-line/PHPCon2016-Workshop.git
$ composer install
```

### database 
```
$ bin/console doctrine:database:create
$ bin/consoledoctrine:schema:update --force
```

### add administrator
```
$ bin/console fos:user:create
```