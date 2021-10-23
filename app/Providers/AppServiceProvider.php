<?php

namespace App\Providers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Inertia::share('app.name', config('app.name'));
        Inertia::share('flash', function () {
            return [
                'successMessage' => Session::get('successMessage'),
            ];
        });
        Inertia::share('errors', function () {
            return Session::get('errors') ? Session::get('errors')->getBag('default')->getMessages() : (object) [];
        });

        /* $this->registerLengthAwarePaginator(); */
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
