<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL; // Pastiin import ini di paling atas
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        if (env('APP_ENV') === 'production') {
        $this->app->bind('path.public', function() {
            return base_path('public');
        });
    }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
      
    }
}
