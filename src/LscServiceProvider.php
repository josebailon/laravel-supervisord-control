<?php

namespace JoseBailon\LaravelSupervisordControl;

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
        $this->app->singleton('Conector', function ($app) {

            return new \Supervisor\Api();
        });
    }
}
