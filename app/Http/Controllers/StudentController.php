<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller{

    public function index(){
        $students = DB::table('students')->get();
        return view('student.students-list', [
            'students' => $students
        ]);
    }

    public function detail($alias){
        $student = DB::table('students')->where('alias', $alias)->first();
		return view('student.student-detail',[
			'student' => $student
		]);
    }

}
