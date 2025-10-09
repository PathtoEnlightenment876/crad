<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        // Share notifications with all views
    View::composer('*', function ($view) {
        if (Auth::check()) {
            $view->with('notifications', Notification::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get());
        }
    });
    }
}
