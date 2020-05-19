<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    //
    public function index(){
        $subjects = DB::table('subjects')->paginate(10);
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

        $request->validate([
            'subjectName' => 'required|unique:subjects|min:2|max:255|alpha_num',
            'department' => 'required|min:2|max:255|alpha_num',
        ]);

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
    public function edit($name){
        $subject = DB::table('subjects')->where('subjectName',$name)->first();
        return view('subject.subject-edit',['subject'=>$subject]);
    }

    public function update(Request $request){
        $id = $request->input('id');

        $request->validate([
            'subjectName' => ['min:2','max:255','required','unique:subjects,subjectName,'.$id],
            'department' => 'required|min:2|max:255',
        ]);

        $subject = DB::table('subjects')->where('id',$id)->update(array(
            'subjectName' => $request->input('subjectName'),
            'department' => $request->input('department'),
        ));
        return redirect()->action('SubjectController@index');
    }
}
