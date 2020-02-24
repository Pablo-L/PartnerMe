<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    private $classroomName; //nombre del aula donde se imparte el turno
    private $day; //día de la semana en que se imparte el turno
    private $beginHour; //hora a la que comienza el turno
    private $endHour; //hora a la que termina el turno
} 