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
    public function boot(){
        
        $this->registerPolicies();
        
        /*
        |--------------------------------------------------------------
        | USUARIOS
        |--------------------------------------------------------------
        */

        Gate::define('manage-users', function($user){
            return $user->hasAnyRoles(['admin', 'professor']);
        });

        Gate::define('edit-users', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('delete-users', function($user){
            return $user->hasRole('admin');
        });

        /*
        |--------------------------------------------------------------
        | RATINGS
        |--------------------------------------------------------------
        */

        Gate::define('puntuate-users', function($user){
            return $user->hasAnyRoles(['admin', 'professor', 'student']);
        });
        
        /*
        |--------------------------------------------------------------
        | ASIGNATURAS
        |--------------------------------------------------------------
        */

        Gate::define('manage-subjects', function($user){
            return $user->hasAnyRoles(['admin', 'professor']);
        });

        /*
        |--------------------------------------------------------------
        | TURNOS
        |--------------------------------------------------------------
        */

        Gate::define('manage-turns', function($user){
            return $user->hasAnyRoles(['admin', 'professor']);
        });

    }
}
