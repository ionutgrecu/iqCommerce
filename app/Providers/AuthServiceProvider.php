<?php

namespace App\Providers;

use App\Services\AccountService;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use function app;
use function auth;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
            // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        Gate::define('isSuperAdmin', function ($user) {
            return $user->role == 'superadmin';
        });

        Gate::define('isAdmin', function ($user) {
            return in_array($user->role, ['superadmin', 'admin']);
        });

        Gate::define('isAuthor', function ($user) {
            return in_array($user->role, ['superadmin', 'admin', 'author']);
        });

        Gate::define('isSubscriber', function ($user) {
            return in_array($user->role, ['superadmin', 'admin', 'author', 'subscriber']);
        });

        app()->singleton(AccountService::class, function ($app) {
            return new AccountService();
        });
       
        app()->singleton(\App\Services\CartService::class,function($app){
            return new \App\Services\CartService();
        });
    }

}
