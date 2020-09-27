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

#### Options in configuration file

|Field|Default|Description|
|---|---|---|
|host| 127.0.0.1|Host where Supervisord is running|
|port| 9001|Port where Supervisord is listening|
|username|user|User name allowed to authenticate with Supervisord|
|password|password|Pasword for that user|
|route_prefix|supervisord|Prefix added to routes used by this package. Control pannel can be accessed in this prefix. for example *https://domain/supervisord*|
|midlewares|null|Middlewares applied to routes used by this package. It is usefull to add the auth middleware if needed. You can specify several middlewares in a comma separated string: 'auth,othermiddleware'
|extend_view|false|You can specify a string with the blade path of a view in order to be extended. For example if you want to extend a layout called *'layouts.path'* you must specify the string in this field: *'layouts.app'*. In order for this to work, next field called *section* must be also populated|
|section|false| Must contain an string with the name of the *@yield* directive  where the view will be shown. For example if the extended view have a blade operator *@yield('content')* you should specify *'content'* in this field|
