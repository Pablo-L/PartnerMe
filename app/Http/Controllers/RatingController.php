<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Student;

class RatingController extends Controller{

    public function calculatePuntuations($id){
        $student = Student::find($id);
        $puntuations = $student->received_ratings;
        
        $totalPuntuation = 0.0;

        foreach($puntuations as $puntuation){
            $totalPuntuation += $puntuation->points;
        }
        
        $averagePuntuation = ( $totalPuntuation / (count($puntuations) > 0 ? count($puntuations) : 1));        
        return $averagePuntuation;
    }

    public function detail($id){
        $student = DB::table('students')->where('id', $id)->first();
        $student = Student::find($id);
        $puntuation = $this->calculatePuntuations($id);
        $student->puntuation = $puntuation;
        $ratings = $student->received_ratings;
        return view('rating.rating-page',[
            'student' => $student,
            'ratings' => $ratings
		]);
    }

    public function upload(Request $request){

        $validatedData = $request->validate([
            'points' => 'required|integer|between:0,10',
            'comment' => 'required',
        ]);


        $rating = DB::table('ratings')->insert(array(
            'student_id_creator' => $request->input('student_creator_id'),
            'student_id_receiver' => $request->input('student_receiver_id'),
            'points' =>  $request->input('points'),
            'comment' => $request->input('comment'),
        ));

        $alias = $request->input('student_alias');
        $student = DB::table('students')->where('alias', $alias)->first();
        $puntuation = $this->calculatePuntuations($student->id);
        DB::table('students')->where('alias',$alias)->update(array(
            'puntuation'=>  number_format($puntuation, 2, '.', ''),
        ));

        return redirect()->action('RatingController@detail', ['id' => $student->id]);
    }


}
