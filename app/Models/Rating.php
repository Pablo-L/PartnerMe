<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model{

    private $points;
    private $comment;
    private $student_id_creator;
    private $student_id_receiver;

    protected $fillable = [
        'user_id_creator', 'user_id_creator', 'points', 'comment',
    ];
    
    public function student_creator(){
        return $this->belongsTo('App\Student', 'student_id_creator', 'id');
    }

    public function student_receiver(){
        return $this->belongsTo('App\Student', 'student_id_receiver', 'id');
    }

    //public function __destruct(){
    //    echo 'Destruyendo rating creado por : ' . $this->student_id_creator . PHP_EOL;
    //}

}

