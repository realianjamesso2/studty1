<?php

namespace MakeEasySolutions\AccountPart;

use Illuminate\Support\ServiceProvider;

class AccountPartServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'make-easy-solutions');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'make-easy-solutions');
        $this->loadViewsFrom(__DIR__.'/resources/views/user', 'mes-user');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        app('router')->aliasMiddleware('role',\Spatie\Permission\Middlewares\RoleMiddleware::class);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/account-part.php', 'account-part');

        // Register the service the package provides.
        $this->app->singleton('account-part', function ($app) {
            return new AccountPart;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['account-part'];
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
            __DIR__.'/../config/account-part.php' => config_path('account-part.php'),
        ], 'account-part.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/make-easy-solutions'),
        ], 'account-part.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/make-easy-solutions'),
        ], 'account-part.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/make-easy-solutions'),
        ], 'account-part.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
