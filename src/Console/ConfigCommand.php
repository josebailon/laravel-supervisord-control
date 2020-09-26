<?php

namespace JoseBailon\LaravelSupervisordControl\Console;

use Illuminate\Console\Command;

class ConfigCommand extends Command
{
    protected $signature = 'lsc:config';
    protected $description = 'Publish config file';
    public function handle()
    {
        if (is_null(config('jbosupervisord'))) {
            return $this->warn('Please publish the config file by running \'php artisan vendor:publish --tag=lsc-config\'');
        }
        //ejecucion del comando
        $this->info("info");
        $this->warn("aviso");
        $this->error("error");
    }
}
