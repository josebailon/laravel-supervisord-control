# JBO Laravel Supervisord Control Panel

This Laravel package generates a panel where Supervisord can be controlled through HTTP/XML-RPC requests under the hood.

### Instalation
```
composer require josebailon/laravel-supervisord-control
```

### Route name
Route to control panel can be referenced with name *lsc_index*
```
<?php
route('lsc_index');

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

### Options in configuration file

|Field|Default|Description|
|---|---|---|
|host| 127.0.0.1|Host where Supervisord is running|
|port| 9001|Port where Supervisord is listening|
|username|user|User name allowed to authenticate with Supervisord|
|password|password|Pasword for that user|
|route_prefix|supervisord|Prefix added to routes used by this package. Control pannel can be accessed in this prefix. for example *https://<span></span>domain/supervisord*|
|midlewares|null|Middlewares applied to routes used by this package. It is usefull to add the auth middleware if needed. You can specify several middlewares in a comma separated string: 'auth,othermiddleware'
|extend_view|false|You can specify a string with the Blade path of a view in order to be extended. For example if you want to extend a layout called *'layouts.path'* you must specify that string in this field. In order for this to work, next field called *section* must be populated too|
|section|false| Must contain a string with the name of the *@yield* directive  where the view will be shown. For example if the extended view have a Blade operator *@yield('content')* you should specify *'content'* in this field|

### Supervisord configutarion
Supervisord must have configured [inet_http_server](http://www.supervisord.org/configuration.html#inet-http-server-section-settings). This server should never be exposed directly to public internet and should use username and password. Read the security advices in the link.



### Customizing the view
The default view has Bootstrap css clases in its elements. If you want to behave like that simply add Bootstrap to the extended view used.

If you whant to customize the view, publish the views to /resources/views/vendor/lsc using:
```
php artisan vendor:publish --tag=lsc-views
```

*index.blade.php* is the main view called by this package. You can override the extending view behaviour in that file.

*content.blade.php* is the view containing all tables and buttons. You can edit css classes to your needs in that file.