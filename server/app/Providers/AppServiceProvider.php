<?php

namespace App\Providers;

use App\Lib\Rates\CurrentRatesFetcher;
use App\Lib\Rates\RatesFetcher;
use App\Lib\Rates\StaticRatesFetcher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RatesFetcher::class, function () {
            if (config('rates.static-rates')) {
                return new StaticRatesFetcher();
            }
            return new CurrentRatesFetcher();
        });
    }
}
