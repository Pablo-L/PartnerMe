<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model{
    
    private $phone;
    private $description;

    public function turns(){
        return $this->belongsToMany('App\Turn');
    }

}
