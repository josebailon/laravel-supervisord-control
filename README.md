# laravel-supervisord-control

Laravel package for controlling Supervisord processes.

### Instalation
```
composer require josebailon/laravel-supervisord-control
```

### Configuration

Default configuration and view will be used if no configuration file or view are published.

To publish configuration file to /config/jbosupervisord.php you need to run:
```
php artisan vendor:publish --tag=lsc-config
```
To publish used view to /resources/views/vendor/lsc
```
php artisan vendor:publish --tag=lsc-views
```

#### Options on configuration file


<?php

|Field|Default|Description|
|---|---|---|
|host| 127.0.0.1|Host where Supervisord is running|
|port| 9001|Port where Supervisord is listening|
|username|user|User name allowed to authenticate with Supervisord|
|password|password|Pasword for that user|
|route_prefix|supervisord|Prefix added to routes used by this package. Control pannel can be accessed in this prefix. for example https://domain/supervisord|
