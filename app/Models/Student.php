<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\TraitUseAdaptation\Alias;

class Student extends Model{
    
    private $phone;
    private $description;

    //Como de momento no existe la clase user, el estudiante necesita...
    private $alias;
    private $name;
    private $lastName;
    private $email;
    private $password;
    private $studies;
    private $course;
    private $puntuation;

    protected $fillable = [
        'phone', 'description', 'alias', 'name', 'lastName', 'email', 'password', 'studies', 'course', 'puntuation',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
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
        return $this->hasMany('App\Rating', 'student_id_creator', 'id');
    }

    public function received_ratings(){
        return $this->hasMany('App\Rating', 'student_id_receiver', 'id');
    }

/*
    public function __construct(){
        $this->phone = "634563726";
        $this->description = "defaultDescription";
        $this->alias = "default";
        $this->name = "defaultName";
        $this->lastName = "defaultLastName";
        $this->email = "default@default.com";
        $this->password = "1234";
        $this->studies = "Ingenieriía informática";
        $this->course = 3;
    }
*/

   /* public function __constructAll($phone, $description, $alias, $name, $lastName, $email, $password, $studies, $course){
        $this->phone = $phone;
        $this->description = $description;
        $this->alias = $alias;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->studies = $studies;
        $this->course = $course; 
    }
*/

    //public function __destruct(){
    //    echo 'Destruyendo: ' . $this->alias . PHP_EOL;
    //}



}
