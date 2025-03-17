<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Institute;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    // Share institutes data with all views
    View::composer('*', function ($view) {
        $institutes = Institute::where('status', 'approved')->get();
        $view->with('institutes', $institutes);
    });
}
}
