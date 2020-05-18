<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    private $groupName; //nombre del grupo
    private $description; //descripción del grupo
    private $image; //imagen del grupo
    private $turn_id; //clave ajena a Turn

    //relación con User
    public function users(){
        return $this->belongsToMany('App\User');
    }

    //relación con Turn
    public function turns(){
        return $this->belongsTo('App\Turn');
    }
}
