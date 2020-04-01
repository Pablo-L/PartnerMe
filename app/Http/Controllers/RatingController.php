<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Student;

class RatingController extends Controller{


    public function detail($id){
        $student = DB::table('students')->where('id', $id)->first();
        $student = Student::find($id);
        $ratings = $student->received_ratings;
        return view('rating.rating-page',[
            'student' => $student,
            'ratings' => $ratings
		]);
    }


}
