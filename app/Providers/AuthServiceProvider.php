<?php

namespace App\Providers;

use App\Property;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerPropertyPolicies();
    }

    /**
     * Setting up access levels for following functionalities
     * create-property
     * edit-property
     * delete-property
     * view-property
     *
     * create-property-unit
     * edit-property-unit
     * delete-property-unit
     * view-property-unit
     *
     * create-issue
     * update-issue
     * view-issue
     *
     * create-payment
     * update-payment
     * view-payment
     *
     * create-invite view-payment
     */
    public function registerPropertyPolicies()
    {
        Gate::define('create-property', function ($user){
            return $user->hasAccess(['create-property']); });
        Gate::define('edit-property', function ($user, Property $property){
            return $user->hasAccess(['edit-property']) or $user->id == $property->user_id; });
        Gate::define('create-property', function ($user){
            return $user->hasAccess(['create-property']); });
        Gate::define('view-property', function ($user){
            return $user->hasAccess(['view-property']); });

        Gate::define('create-property-unit', function ($user){
            return $user->hasAccess(['create-property-unit']);
        });
        Gate::define('view-property-unit', function ($user){
            return $user->hasAccess(['view-property-unit']);
        });
        Gate::define('create-invite', function ($user){
            return $user->hasAccess(['create-invite']);
        });
        Gate::define('create-payment', function ($user){
            return $user->hasAccess(['create-payment']);
        });
        Gate::define('view-payment', function ($user){
            return $user->hasAccess(['view-payment']);
        });
        Gate::define('create-issue', function ($user){
            return $user->hasAccess(['create-issue']);
        });
        Gate::define('view-issue', function ($user){
            return $user->hasAccess(['view-issue']);
        });
        Gate::define('forum', function ($user){
            return $user->hasAccess(['forum']);
        });
    }
}
