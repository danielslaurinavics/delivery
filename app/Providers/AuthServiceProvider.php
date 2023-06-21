<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
		
		// Order policies
		Gate::define('view-orders', function ($user) {
			return $user->role === 'user';
		});
		
		Gate::define('view-rest-orders', function ($user) {
			return $user->role === 'restaurant';
		});
		
		Gate::define('view-cour-orders', function ($user) {
			return $user->role === 'courier';
		});
		
		Gate::define('create-orders', function ($user) {
			return $user->role === 'user';
		});
		
		// Rating policies
		Gate::define('create-ratings', function ($user) {
			return $user->role === 'user';
		});
		
		Gate::define('view-rest-rating', function ($user) {
			return $user->role === 'restaurant';
		});
		
		Gate::define('view-cour-rating', function ($user) {
			return $user->role === 'courier';
		});
		
		// User management policies
		Gate::define('manage-users', function ($user) {
			return $user->role === 'admin';
		});
		
		Gate::define('block-users', function ($user) {
			return $user->role === 'admin';
		});
		
		Gate::define('change-role', function ($user) {
			return $user->role === 'admin';
		});
		
		// Dish policies
		Gate::define('ced-dishes', function ($user) {
			return $user->role === 'restaurant';
		});
		
		Gate::define('view-dishes', function ($user) {
			return $user->role === 'user';
		});
		
		Gate::define('view-dishes-rest', function ($user) {
			return $user->role === 'restaurant';
		});
    }
}
