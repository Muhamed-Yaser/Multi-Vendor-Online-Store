<?php

namespace App\Providers;

use App\Services\CurrencyConverter;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('currency.converter', function ($app) {
            // Fetch the API key from the config or environment file
            $apiKey = config('services.currency_converter.api_key');

            return new CurrencyConverter($apiKey);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // App::setlocale(request('locale' , 'en'));
    }
}
