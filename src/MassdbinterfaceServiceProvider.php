<?php

namespace Weblid\Massdbinterface;

use Illuminate\Support\ServiceProvider;

class MassdbinterfaceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'massdbinterface');
        $this->publishes([
            __DIR__.'/config/massdbinterface.php' => config_path('massdbinterface.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Massdbinterface::class, function ($app) {
            return new Massdbinterface();
        });
    }
}
