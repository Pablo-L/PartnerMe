<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller{

    public function index(){
        $students = DB::table('students')->paginate(20);
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

    public function delete($alias){
		$student = DB::table('students')->where('alias', $alias)->delete();
		//return redirect()->action('StudentController@index')->with('status', 'El estudiante ' . $alias . ' ha sido borrado correctamente');
        return response()->json(['status'=>'El estudiante ' . $alias . ' ha sido borrado correctamente']);
    }

    public function edit($alias){
		$student = DB::table('students')->where('alias', $alias)->first();
		
		return view('signup',[
			'student' => $student
		]);
    }

    public function update(Request $request){
		$id = $request->input('id');
		
		$student = DB::table('students')->where('id', $id)
									    ->update(array(
                                            'phone' => $request->input('phone'),
                                            'description' => $request->input('description'),
                                            'alias' => $request->input('alias'),
                                            'name' =>  $request->input('name'),
                                            'lastName' =>  $request->input('lastName'),
                                            'email' =>  $request->input('email'),
                                            'password' =>  $request->input('password'),
                                            'studies' =>  $request->input('degree'),
                                            'course' =>  $request->input('course'),
									    ));
        return redirect()->action('StudentController@index')
            ->with('status', 'El estudiante ' . $request->input('alias') . ' ha sido modificado correctamente');
    }

    public function save(Request $request){
        $student = DB::table('students')->insert(array(
            'phone' => $request->input('phone'),
            'description' => $request->input('description'),
            'alias' => "@" . $request->input('alias'),
            'name' =>  $request->input('name'),
            'lastName' =>  $request->input('lastName'),
            'email' =>  $request->input('email'),
            'password' =>  $request->input('password'),
            'studies' =>  $request->input('degree'),
            'course' =>  $request->input('course'),
		));
		
        return redirect()->action('StudentController@index')
            ->with('status', 'El estudiante ' . "@" . $request->input('alias') . ' ha sido creado correctamente');
    }

}
