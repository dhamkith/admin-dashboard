<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Permission;
use Illuminate\Support\Facades\Schema;

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

        $this->registerCanUserPolicies();
    }

    public function registerCanUserPolicies() {

        if (Schema::hasTable('permissions')) {
            
            $permissions = Permission::all();

            foreach( $permissions as $permission)
            {
                Gate::define($permission->slug, function($user) use ($permission){
                    return $user->hasPermission($permission);
                });
            }
                
        }
        
    }
}
