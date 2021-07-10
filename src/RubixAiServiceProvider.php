<?php

namespace Torian257x\RubixAi;

use Illuminate\Support\ServiceProvider;

class RubixAiServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'torian257x');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'torian257x');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/rubixai.php', 'rubixai');

        // Register the service the package provides.
        $this->app->singleton('rubixai', function ($app) {
            return new RubixAi;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['rubixai'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/rubixai.php' => config_path('rubixai.php'),
        ], 'rubixai.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/torian257x'),
        ], 'rubixai.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/torian257x'),
        ], 'rubixai.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/torian257x'),
        ], 'rubixai.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
