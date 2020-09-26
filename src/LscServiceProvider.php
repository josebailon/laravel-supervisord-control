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
        $this->registerBindings();
        $this->registerPublishing();
        $this->registerViews();
        $this->registerRoutes();
    }
    /**
     * REGISTER
     */
    public function register()
    {
        $this->registerCommands();
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
    protected function registerPublishing()
    {
        $this->publishes(
            [
                __DIR__ . '/../config/jbosupervisord.php' => config_path('jbosupervisord.php')
            ],
            'lsc-config'
        );
    }
    /**
     * BINDINGS
     */
    protected function registerBindings()
    {
        $this->app->singleton('\Supervisor\Api', function ($app) {

            return new \Supervisor\Api(config('jbosupervisord.host'), config('jbosupervisord.port'), config('jbosupervisord.username'), config('jbosupervisord.password'));
        });
    }
    /**
     * VIEWS
     */
    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'lsc');
    }

    /**
     * RUTAS
     */
    protected function registerRoutes()
    {
        Route::group($this->routesConfig(), function () {
            $this->loadroutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    protected function routesConfig()
    {
        return [
            'prefix' => config('jbosupervisord.route_prefix'),
            'namespace' => 'JoseBailon\LaravelSupervisordControl\Http\Controllers'
        ];
    }
}
