<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MongoDBServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register MongoDB services
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Prevent Laravel from trying to resolve 'db' class
        if ($this->app->bound('db')) {
            $this->app->forgetInstance('db');
        }
    }
}