<?php

namespace Cblink\DTO;

use Cblink\DTO\Commands\DTOMakeCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()){
            $this->commands([
                DTOMakeCommand::class,
            ]);
        }
    }

}