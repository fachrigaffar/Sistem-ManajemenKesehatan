<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // You can register additional services here if needed
        $this->registerPolicies();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the defined policies
        $this->registerPolicies();

        // Define 'dokter' gate
        Gate::define('dokter', function (User $user): bool {
            return $user->role === 'dokter';
        });

        // Define 'pasien' gate
        Gate::define('pasien', function (User $user): bool {
            return $user->role === 'pasien';
        });
    }
}