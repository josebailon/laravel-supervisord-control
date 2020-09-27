<?php

namespace JoseBailon\LaravelSupervisordControl\Console;

use Illuminate\Console\Command;

class ConfigCommand extends Command
{
    protected $signature = 'lsc:help';
    protected $description = 'Help for josebailon/laravel-supervisord-control package';
    public function handle()
    {
        $this->line("*******************************************");
        $this->line("josebailon/laravel-supervisord-control help");
        $this->line("*******************************************");
        if (!file_exists(config_path('jbosupervisord.php'))) {
            $this->error('Configuration file is not published. Default values will be used.');
        }
        $this->info('You can publish the config file by running \'php artisan vendor:publish --tag=lsc-config\'');
        $this->info('Published configuration will be available in config/jbosupervisord.php');
        //ejecucion del comando
        $this->line("");
        $this->info('You can publish package views to /resources/views/vendor/lsc by runing \'php artisan vendor:publish --tag=lsc-views\'');
    }
}
