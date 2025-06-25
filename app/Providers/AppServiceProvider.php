<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function boot(): void
    {
        URL::forceScheme('https');
        Inertia::share('flash', function () {
            return ['status' => Session::get('status')];
        });
    }

    public function register(): void
    {
        //
    }


}
