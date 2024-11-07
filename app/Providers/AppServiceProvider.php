<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;


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
        // Sopir
        Gate::define('sopir', function (User $user) {
            return $user->role_id == 1;
        });

        // Manager
        Gate::define('manager', function (User $user) {
            return $user->role_id == 2;
        });

        // Super Visor
        Gate::define('supervisor', function (User $user) {
            return $user->role_id == 3;
        });

        // Admin
        Gate::define('admin', function (User $user) {
            return $user->role_id == 4;
        });

        // Super
        Gate::define('super', function (User $user) {
            return $user->role_id == 6;
        });



    }
}
