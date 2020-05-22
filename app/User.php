<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'description', 'alias', 'lastName','studies', 'course', 'puntuation', 'image',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'puntuation' => 'float',
    ];

    public function turns(){
        return $this->belongsToMany('App\Turn');
    }

    //relación con Group
    public function groups(){
        return $this->belongsToMany('App\Group');
    }

    public static function puntuation($s){
        return $s->ratings;
    }

    public function created_ratings(){
        return $this->hasMany('App\Rating', 'user_id_creator', 'id');
    }

    public function received_ratings(){
        return $this->hasMany('App\Rating', 'user_id_receiver', 'id');
    }

    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    //Comprobamos si el usuario tiene algunos de roles pasados por parámetro
    public function hasAnyRoles($roles){
        if($this->roles()->whereIn('rolName', $roles)->first()){
            return true;
        }

        return false;
    }

    //Comprueba si el usuaio tiene el rol pasado por parámetro
    public function hasRole($role){
        if($this->roles()->where('rolName', $role)->first()){
            return true;
        }

        return false;
    }

}
