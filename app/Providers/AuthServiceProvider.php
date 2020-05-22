<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Group;

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
        Gate::define('edit-roles', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('manage-users', function($user){
            return $user->hasAnyRoles(['admin', 'professor']);
        });

        Gate::define('edit-users', function($user, $userToEdit = null){
            if($userToEdit !== null){
                return $user->id === $userToEdit->id || $user->hasRole('admin');
            }

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

        /*
        |--------------------------------------------------------------
        | GRUPOS
        |--------------------------------------------------------------
        */

        Gate::define('edit-groups', function($user, $groupId){
            $belongsToGroup = false;
            
            $g = Group::find($groupId);

            foreach($g->users as $u){
                if($u->id == Auth::user()->id){
                    $belongsToGroup = true;
                }
                //var_dump($u);
            }

            if(!$belongsToGroup && $user->hasAnyRoles(['admin', 'professor'])){
                $belongsToGroup = true;
            }
            
            return $belongsToGroup;
        });

        Gate::define('delete-groups', function($user, $groupId){
            $belongsToGroup = false;
            
            $g = Group::find($groupId);

            foreach($g->users as $u){
                if($u->id == Auth::user()->id){
                    $belongsToGroup = true;
                }
                //var_dump($u);
            }

            if(!$belongsToGroup && $user->hasAnyRoles(['admin', 'professor'])){
                $belongsToGroup = true;
            }
            
            return $belongsToGroup;
        });
    }
}
