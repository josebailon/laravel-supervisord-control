<?php

namespace JoseBailon\LaravelSupervisordControl;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LscServiceProvider extends ServiceProvider
{
    /**
     * BOOT
     */
    public function boot()
    {
        $this->bootBindings();
        $this->bootPublishing();
        $this->bootViews();
        $this->bootRoutes();
    }
    /**
     * REGISTER
     */
    public function register()
    {
        $this->registerCommands();
        //config
        $this->mergeConfigFrom(__DIR__ . '/../config/jbosupervisord.php', 'jbosupervisord');
    }
    /**
     * COMANDOS
     */
    protected function registerCommands()
    {
        $this->commands([
            Console\ConfigCommand::class
        ]);
    }
    /**
     * PUBLICABLES
     */
    protected function bootPublishing()
    {
        $this->publishes(
            [
                __DIR__ . '/../config/jbosupervisord.php' => config_path('jbosupervisord.php')
            ],
            'lsc-config'
        );
        $this->publishes([__DIR__ . '/../resources/views' => resource_path('views/vendor/lsc')], 'lsc-views');
    }
    /**
     * BINDINGS
     */
    protected function bootBindings()
    {

        $this->app->bind('Supervisor\Api', function ($app) {
            $lscconector = new \Supervisor\Api(config('jbosupervisord.host'), config('jbosupervisord.port'), config('jbosupervisord.username'), config('jbosupervisord.password'));
            try {
                $lscconector->getApiVersion();
            } catch (\Throwable $th) {
            }
            return $lscconector;
        });
    }
    /**
     * VIEWS
     */
    protected function bootViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'lsc');
    }

    /**
     * RUTAS
     */
    protected function bootRoutes()
    {
        Route::group($this->routesConfig(), function () {
            $this->loadroutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    protected function routesConfig()
    {
        return [
            'prefix' => config('jbosupervisord.route_prefix'),
            'namespace' => 'JoseBailon\LaravelSupervisordControl\Http\Controllers',
            'middleware' => array_filter(array_unique(array_merge(['web'], explode(',', config('jbosupervisord.midlewares')))))
        ];
    }
}
