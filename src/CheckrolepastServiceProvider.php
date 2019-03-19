<?php

namespace Farbesofts\Checkrolepast;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class CheckrolepastServiceProvider extends ServiceProvider
{

    protected $defer = false;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/checkrolepast.php' => config_path('checkrolepast.php'),
            __DIR__.'/view/notaccess.blade.php' => resource_path('views/notaccess.blade.php')
        ]);

        if (version_compare(Application::VERSION, '5.3.0', '<')) {
            $this->publishes([
                __DIR__ . '/../migrations' => $this->app->databasePath() . '/migrations',
            ], 'migrations');
        } else {
            if (config('checkrolepast.run-migrations', true)) {
                $this->loadMigrationsFrom(__DIR__ . '/../migrations');
            }
        }

    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/checkrolepast.php', 'checkrolepast',
            __DIR__.'/view/notaccess.blade.php','notaccess'
        );
    }

    public function provides()
    {
        return ['checkrole'];
    }
}
