<?php

namespace Danilowa\LaravelQuotesManagement;

use Illuminate\Support\ServiceProvider;

class QuotesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // ...
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations' => __DIR__ . '/../database/migrations',
        ], 'quotes-migration');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
