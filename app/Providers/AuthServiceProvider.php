<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // pembayaran
        Gate::define('pembayaran', function($user){
            return in_array('pembayaran', explode(",", $user->permissions));
        });

        // list pembayaran item
        Gate::define('dashboard', function($user){
            return in_array('dashboard', explode(",", $user->permissions));
        });

        // checkout
        Gate::define('checkout', function($user){
            return in_array('checkout', explode(",", $user->permissions));
        });

        // profile
        Gate::define('profile', function($user){
            return in_array('profile', explode(",", $user->permissions));
        });
    }
}
