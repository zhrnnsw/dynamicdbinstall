<?php

namespace zhrnnsw\dynamicdbinstall;

use Illuminate\Support\ServiceProvider;

class InstallServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->publishes([
            __DIR__ . '/../../routes/web.php' => base_path('routes/zhrnnsw/dynamicdbinstall.php'),
        ], 'routes');
        $this->loadViewsFrom(__DIR__ . '/views', 'form');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/dynamicdbinstall.php', 'dynamicdbinstall');
    }
}