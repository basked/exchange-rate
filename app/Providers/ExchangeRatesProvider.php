<?php

namespace App\Providers;

use App\Contracts\Exchanger;
use App\Contracts\ExchangerContract;
use App\Services\ExchangerNbrb;
use Illuminate\Support\ServiceProvider;

class ExchangeRatesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ExchangerContract::class, function ($app) {
            return new ExchangerNbrb();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
