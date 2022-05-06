<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        /* define a Admin user role */
        Gate::define('isAdmin', function ($user) {
            return $user->role == '1';
        });

        /* define a Sub Admin role */
        Gate::define('isSubAdmin', function ($user) {
            return $user->role == '3';
        });

        /* define a User role */
        Gate::define('isUser', function ($user) {
            return $user->role == '4';
        });

    }
}
