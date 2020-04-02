<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    private $groupName; //nombre del grupo
    private $description; //descripción del grupo
    private $image; //imagen del grupo
    private $turn_id; //clave ajena a Turn

    //relación con Student
    public function students(){
        return $this->belongsToMany('App\Student');
    }

    //relación con Turn
    public function turns(){
        return $this->belongsTo('App\Turn');
    }
}
