<?php

namespace App\Providers;

use App\Lib\Rates\CurrentRatesFetcher;
use App\Lib\Rates\RatesFetcher;
use App\Lib\Rates\StaticRatesFetcher;
use App\User;
use Illuminate\Support\Facades\URL;
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
        URL::useOrigin(config('app.url'));
        \Gate::define('viewPulse', function (User $user) {
            return $user->hasRole('superadmin') || $user->hasRole('admin');
        });
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
                return new StaticRatesFetcher;
            }

            return new CurrentRatesFetcher;
        });
    }
}
