<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Group;
use App\Turn;
use App\Subject;

class GroupController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $groups = DB::table('groups')->paginate(20);
        return view('group.groups-list',['groups'=>$groups]);
    }

    public function edit($id){
        $group=Group::find($id);
        $turns=DB::table('turns')
                    ->join('subjects','turns.subject_id','=','subjects.id')
                    ->select('turns.*','subjects.subjectName')
                    ->orderBy('subjectName')
                    ->get();
        return view('group.group-edit',['group'=>$group,'turns'=>$turns]);
    }

    public function delete($id){
        $groups_users=DB::table('group_user')->where('group_id',$id)->delete();
        $group=Group::find($id);
        $group->delete();
        return back();
    }

    public function update(Request $request){
        $group=Group::find($request->input('id'));
        $group->groupName=$request->input('groupName');
        $group->description=$request->input('description');
        $group->turn_id=$request->input('turn');
        if($request->file('image')){
            if($request->file('image')->isValid()){
                $path='/public/group_img';
                $fileName=$group->id . date('_m_d_y_H_i_s') . '.' . $request->file('image')->extension();
                $request->file('image')->storeAs($path, $fileName);
                $group->image=$fileName;
            }
        }
        $group->save();
        return redirect()->action('GroupController@detail',[$group->id]);
    }

    public function create(){
        $turns=DB::table('turns')
                    ->join('subjects','turns.subject_id','=','subjects.id')
                    ->select('turns.*','subjects.subjectName')
                    ->orderBy('subjectName')
                    ->get();
        return view('group.group-create',['turns'=>$turns]);
    }

    public function save(Request $request){
        $group = new Group();
        $group->groupName=$request->input('groupName');
        $group->description=$request->input('description');
        $group->turn_id=$request->input('turn');
        $group->image='default.png';
        $group->save();
        if($request->file('image')->isValid()){
            $path='/public/group_img';
            $fileName=$group->id . date('_m_d_y_H_i_s') . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs($path, $fileName);
            $group->image=$fileName;
            $group->save();
        }
        return redirect()->action('GroupController@detail',[$group->id]);
    }

    public function detail($id){
        $group = DB::table('groups')->where('id',$id)->first();
        $turn = DB::table('turns')->where('id',$group->turn_id)->first();
        $subject = DB::table('subjects')->where('id',$turn->subject_id)->first();
        $users = DB::table('group_user')->where('group_id',$id)
                        ->join('users','group_user.user_id','=','users.id')
                        ->select('users.*')
                        ->get();
        foreach($users as $user){
            $user->avgRating=app('App\Http\Controllers\UserController')->calculatePuntuations($user->id);
        }
        return view('group.group-detail',['group'=>$group,'turn'=>$turn,'subject'=>$subject,'users'=>$users]);
    }
}
