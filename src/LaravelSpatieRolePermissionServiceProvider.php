<?php

namespace Mdhesari\LaravelSpatieRolePermission;

use Illuminate\Support\ServiceProvider;

class LaravelSpatieRolePermissionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');

        if ( $this->app->runningInConsole() ) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-spatie-role-permission.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-spatie-role-permission');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-spatie-role-permission', function () {
            return new LaravelSpatieRolePermission;
        });
    }
}
