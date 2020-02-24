<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    private $subjectName;//nombre de la asignatura
    private $department;//departamento de la asignatura
    
    public function turns(){
        return $this->hasMany('App\Turn');
    }
}
