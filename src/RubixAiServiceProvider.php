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
        $this->mergeConfigFrom(__DIR__ . '/../config/rubixai_config.php', 'rubixai');

        $this->app->singleton('rubixai', function ($app) {
            return new RubixAiService;
        });

        if(!defined('RUBIXAI_CUSTOM_CONFIG')){
            define('RUBIXAI_CUSTOM_CONFIG', config('rubixai'));
        }
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
            __DIR__ . '/../config/rubixai_config.php' => config_path('rubixai.php'),
        ], 'rubixai.config');

    }
}
