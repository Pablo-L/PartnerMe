<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Subject;
class TurnController extends Controller
{
    public function index(){
        $turns =DB::table('turns')
                    ->join('subjects','turns.subject_id','=','subjects.id')
                    ->select('turns.*','subjects.subjectName')
                    ->paginate(20);
        return view('turn.turns-list', [
            'turns' => $turns
        ]);
    }

    public function detail($id){
        $turn=DB::table('turns')
                    ->join('subjects','turns.subject_id','=','subjects.id')
                    ->select('turns.*','subjects.subjectName')
                    ->where('turns.id',$id)
                    ->first();
        return view('turn.turns-list-data',['turn'=>$turn]);
    }

    public function create(){
        $subjects = Subject::all();
        return view('turn.turns-create',['subjects'=>$subjects]);
    }


    public function postForm(Request $request){
        if($request->has('classroomName')){//admitimos que el resto de campos se rellenan
            $subject = DB::table('turns')->insert(array(
            'classroomName' => $request->input('classroomName'),
            'day' => $request->input('day'),
            'beginHour' => $request->input('beginHour'),
            'endHour' => $request->input('endHour'),
            'subject_id'=> $request->input('subject_id')
            ));
        }
        return redirect()->action('TurnController@index');
    }

    public function delete($id){
		$student = DB::table('turns')->where('id', $id)->delete();
        return redirect()->action('TurnController@index');
    }

    public function edit($id){
		$turn = DB::table('turns')->where('id',$id)->first();
        return view('turn.turns-edit',['turn'=>$turn]);
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
