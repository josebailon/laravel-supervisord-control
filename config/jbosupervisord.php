<?php

/**
     * 
     *  josebailon/laravel-supervisord-control configuration file
     * 
     * 
     */

return [
    /*
     * supervisord host
     */
    'host' => '127.0.0.1',
    /*
     * supervisord port
     */
    'port' => '9001',
    /*
     * supervisord username
    */
    'username' => 'user',
    /*
    * supervisord password
    */
    'password' => 'password',

    /*
     * this prefix wil be added to routes used by this package
     */
    'route_prefix' => 'supervisord',

    /**
     * Midlewares you would like to add to routes used by this package.
     * You can specify multiple middlewares coma separated(no space). Leave empty string if you dont want any
     */
    //'midlewares' => 'auth,othermiddleware',
    'midlewares' => '',

    /*
    * Extending other view. 
    * Use this if you want to extend other view. For example when using a template with a 
    * section and you want to show the views of package josebailon/laravel-supervisord-control inside it.
    * Example:*/
    //'extend_view' => 'layouts.app',
    //'section' => 'content'
    'extend_view' => false,
    'section' => false
];
