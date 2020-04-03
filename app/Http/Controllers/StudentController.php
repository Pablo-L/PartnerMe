<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;
use App\Student;

class StudentController extends Controller{


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

    public function index(){
        //$students = DB::table('students')->paginate(20);
        //return view('student.students-list', [
        //    'students' => $students
        //]);
        //$students = Student::all()
        
        $students = DB::table('students')->paginate(20);
        //foreach($students as $student){$student->puntuation = $this->calculatePuntuations($student->id);}
        return view('student.students-list', compact('students'));
    }

    function fetch_data(Request $request){
       
        if($request->ajax()){
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');

            $students = DB::table('students')->orderBy($sort_by, $sort_type)->paginate(20);
            return view('student.students-list-data', compact('students'))->render();
        }
    }

    public function detail($alias){
        $student = DB::table('students')->where('alias', $alias)->first();
        $puntuation = $this->calculatePuntuations($student->id);
        $student->puntuation = $puntuation;

        return view('student.student-detail',[
			'student' => $student
		]);
    }

    public function delete($alias){

        $student = DB::table('students')->where('alias', $alias)->first();
        //Eliminamos todos los ratings creados y recibidos por el ususario
        DB::table('ratings')->where('student_id_creator', $student->id)->delete();
        DB::table('ratings')->where('student_id_receiver', $student->id)->delete();

        DB::table('students')->where('id', $student->id)->delete();
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
