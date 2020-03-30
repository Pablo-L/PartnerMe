<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller{

    public function index(){
        $students = DB::table('turns')->get();
        return view('turn.turns-list', [
            'turns' => $turns
        ]);
    }

    public function detail($id){
        $student = DB::table('turns')->where('id', $id)->first();
		return view('turn.turn-turn',[
			'turn' => $turn
		]);
    }

    public function delete($id){
		$student = DB::table('turns')->where('id', $id)->delete();
		//return redirect()->action('StudentController@index')->with('status', 'El estudiante ' . $alias . ' ha sido borrado correctamente');
        return response()->json(['status'=>'El turno ' . $id . ' ha sido borrado correctamente']);
    }

    public function edit($id){
		$student = DB::table('turns')->where('id', $id)->first();
		
		return view('signup',[
			'turn' => $turn
		]);
    }

    public function update(Request $request){
		$id = $request->input('id');
		
		$turn = DB::table('turns')->where('id', $id)
									    ->update(array(
                                            'classroomName' => $request->input('classroomName'),
                                            'day' => $request->input('day'),
                                            'beginHour' => $request->input('beginHour'),
                                            'endHour' =>  $request->input('endHour'),
                                            'subject_id' =>  $request->input('subject_id'),
									    ));
        return redirect()->action('TurnController@index')
            ->with('status', 'El turno ' . $request->input('id') . ' ha sido modificado correctamente');
    }

    public function save(Request $request){
        $student = DB::table('turns')->insert(array(
                                    'classroomName' => $request->input('classroomName'),
                                    'day' => $request->input('day'),
                                    'beginHour' => $request->input('beginHour'),
                                    'endHour' =>  $request->input('endHour'),
                                    'subject_id' =>  $request->input('subject_id'),
		));
		
        return redirect()->action('TurnController@index')
            ->with('status', 'El turno '. $request->input('id') . ' ha sido creado correctamente');
    }

}