<?php

namespace Tienrocker\ThProvinces;

use tienrocker\ThProvinces\Provinces\Provinces;
use tienrocker\ThProvinces\Commands\MigrationCommand;
use Illuminate\Support\ServiceProvider;

class ProvincesServiceProvider extends ServiceProvider
{

    protected $defered = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config/thprovinces.php' => config_path('thprovinces.php'),
        ], 'thprovinces');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/thprovinces.php', 'thprovinces');
        $this->registerProvinces();
        $this->registerCommands();
    }

    /**
     * Register the service provider.
     */
    protected function registerProvinces()
    {
        $this->app->singleton('thprovinces', function ($app) {
            return new Provinces();
        });
    }

    /**
     * Register the artisan command
     */
    protected function registerCommands()
    {
        $this->app->singleton('command.thprovinces.migration', function ($app) {
            return new MigrationCommand();
        });

        $this->commands('command.thprovinces.migration');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('thprovinces');
    }
}
