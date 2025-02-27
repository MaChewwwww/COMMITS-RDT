<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

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
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();
                
                // Get notifications that haven't been viewed by the current user
                $notifications = Notification::whereRaw("NOT JSON_CONTAINS(COALESCE(viewed_by, '[]'), ?)", ['"' . $userId . '"'])
                    ->orderBy('created_at', 'desc')
                    ->get();
                
                $view->with('notifications', $notifications);
            } else {
                $view->with('notifications', collect([]));
            }
        });
    }
}