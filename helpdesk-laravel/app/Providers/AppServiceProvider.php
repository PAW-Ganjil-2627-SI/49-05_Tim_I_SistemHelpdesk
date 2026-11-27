<?php

namespace App\Providers;

use App\Models\AsetPc;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('manage-departemen', function (User $user): bool {
            return $user->isAdmin();
        });

        Gate::define('manage-aset', function (User $user): bool {
            return $user->isAdmin();
        });

        Gate::define('update-kondisi-aset', function (User $user): bool {
            return $user->hasRole('admin', 'teknisi');
        });

        Gate::define('view-aset', static function (?User $user, AsetPc $aset): bool {
            if ($user && $user->isUser()) {
                return $aset->departemen_id === $user->departemen_id;
            }

            return true;
        });
    }
}
