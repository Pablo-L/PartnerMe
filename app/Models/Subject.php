<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    private $subjectName;//nombre de la asignatura
    private $department;//departamento de la asignatura
    
    public function __construct(){
        //echo('Construyo asignatura'.PHP_EOL);
        $this->subjectName = "defaultName";
        $this->department ="defaultDepartment";
    }

    public function __construct2($sub, $dep){
        //echo('Construyo asig'.$sub.PHP_EOL);
        $this->subjectName = $sub;
        $this->department = $dep;
    }

    public function __destruct(){
        //print "Destruyendo " . $this->subjectName.PHP_EOL;
    }

    public function getSubjects(){
        $subs = subject::get(['subjectName']);
        return $subs;
    }

    public function getDepartment($sub){
        $deps = subject::where('subjectName',$sub)->get('department');
        return $deps;
    }

    public function turns(){
        return $this->hasMany('App\Turn');
    }
}
