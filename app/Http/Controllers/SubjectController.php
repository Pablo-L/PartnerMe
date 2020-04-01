<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    //
    public function index(){
        $subjects = DB::table('subjects')->get();
        return view('subject.subjects-list',['subjects'=> $subjects]);
        //return 'Hola mundo';
    }

    public function detail($subjectName){
        $subject = DB::table('subjects')->where('subjectName',$subjectName)->first();
        return view('subject.subject-detail',['subject'=>$subject]); 
    }

    public function create(){
        return view('subject.subject-create');
    }

    public function postForm(Request $request){
        if($request->has('subjectName')){
            if($request->has('department')){
                $subject = DB::table('subjects')->insert(array(
                    'subjectName' => $request->input('subjectName'),
                    'department' => $request->input('department'),
                ));
            }
            
        }
        return redirect()->action('SubjectController@index');
    }

    public function delete($name){
        $subject = DB::table('subjects')->where('subjectName',$name)->delete();
        return redirect()->action('SubjectController@index');

    }
}
