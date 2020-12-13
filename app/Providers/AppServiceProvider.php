<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Synchronously
        Inertia::share([
            'app' => [
                'name' => Config::get('app.name'),
                'url' => request()->getHost(),
                'web_url' => env('App_URL', 'mysaas.test'),
                'lang' => 'eng'
            ],
            // Lazilly
            'auth' => function (){
            return [
                'user' => Auth::user() ? Auth::user() : null,
                ];
            },
            'session' =>[
                'current' => session('session', []),
            ]  

        ]);
    }
}
