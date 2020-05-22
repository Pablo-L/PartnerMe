<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

    public function list(){
        $user=Auth::user();
        $groups = DB::table('groups')
                        ->join('group_user','groups.id','=','group_user.group_id')
                        ->where('user_id',$user->id)
                        ->paginate(5);
        $subjects = DB::table('subjects')
                        ->join('turns','turns.subject_id','=','subjects.id')
                        ->join('groups','groups.turn_id','=','turns.id')
                        ->join('group_user','groups.id','=','group_user.group_id')
                        ->where('user_id',$user->id)
                        ->select('subjects.*')
                        ->distinct()->get();
        return view('group.group-my_groups',['groups'=>$groups,'subjects'=>$subjects,'selected'=>'nulo']);
    }

    public function filteredList(Request $request){
        $user=Auth::user();
        $selected=$request->input('subject');
        if($selected=='nulo'){
            $groups = DB::table('groups')
                        ->join('group_user','groups.id','=','group_user.group_id')
                        ->where('user_id',$user->id)
                        ->paginate(5);
        }else{
            $groups = DB::table('groups')
                        ->join('group_user','groups.id','=','group_user.group_id')
                        ->where('user_id',$user->id)
                        ->join('turns','groups.turn_id','=','turns.id')
                        ->where('turns.subject_id',$selected)
                        ->paginate(5);
        }
        $subjects = DB::table('subjects')
                        ->join('turns','turns.subject_id','=','subjects.id')
                        ->join('groups','groups.turn_id','=','turns.id')
                        ->join('group_user','groups.id','=','group_user.group_id')
                        ->where('user_id',$user->id)
                        ->select('subjects.*')
                        ->distinct()->get();
        return view('group.group-my_groups',['groups'=>$groups,'subjects'=>$subjects,'selected'=>$selected]);
    }

    public function otherList(){
        $user=Auth::user();
        $groups = DB::table('groups')->paginate(10);
        $subjects = DB::table('subjects')->get();
        $selected='nulo';
        $name='';
        return view('group.group-more_groups',['groups'=>$groups,'subjects'=>$subjects,'selected'=>$selected,'name'=>$name]);
    }

    public function otherFilteredList(Request $request){
        $user=Auth::user();
        $selected=$request->input('subject');
        $name=$request->input('nameTb');
        if($selected=='nulo'){
            $groups = DB::table('groups')
                        ->where('groupName', 'LIKE', '%' . $name . '%')
                        ->paginate(10);
        }else{
            $groups = DB::table('groups')
                        ->where('groupName', 'LIKE', '%' . $name . '%')
                        ->join('turns','groups.turn_id','=','turns.id')
                        ->where('turns.subject_id',$selected)
                        ->paginate(10);
        }
        $subjects = DB::table('subjects')->get();
        return view('group.group-more_groups',['groups'=>$groups,'subjects'=>$subjects,'selected'=>$selected,'name'=>$name]);
    }

    public function searchGroups($search = null, Request $request){
        if($request->ajax()){
            $groups = Group::where('groupName', 'LIKE', '%' . $search . '%')->paginate(20);
            $turns = Turn::get();
            return view('group.search_result', compact('groups', 'turns'));
        }
    }

    public function edit($id){
        $group = Group::find($id);

        //$turns=DB::table('turns')
        //            ->join('subjects','turns.subject_id','=','subjects.id')
        //            ->select('turns.*','subjects.subjectName')
        //            ->orderBy('subjectName')
        //            ->get();
        //return view('group.group-edit',['group'=>$group,'turns'=>$turns]);
        $users = $group->users()->get();
        return view('group.group-create',['group' => $group, 'users' => $users]);
    }

    public function delete($id, Request $request){
        $groups_users=DB::table('group_user')->where('group_id',$id)->delete();
        $group=Group::find($id);
        $groupName = $group->groupName;
        if($group->delete()){
            $request->session()->flash('success',  'El grupo \'' . $groupName . '\' ha sido eliminado correctamente');
        }else{
            $request->session()->flash('error',  'El grupo \'' . $groupName . '\' no se pudo eliminar');
        }
        return back();
    }

    public function update(Request $request, Group $group){

        $idAct = $group->id;
        $request->validate([
            'groupName' => ['min:2','max:255','required','unique:groups,groupName,'.$idAct],
            'description' => 'required|min:2|max:255',
        ]);

        $group->groupName = $request->groupName;
        $group->description = $request->description;
        $group->turn_id = $request->turn;
        
        if($request->file('image')){
            if($request->file('image')->isValid()){
                $path='/public/group_img';
                $fileName = $group->id . date('_m_d_y_H_i_s') . '.' . $request->file('image')->extension();
                $request->file('image')->storeAs($path, $fileName);
                $group->image = $fileName;
            }
        }

        $group->users()->sync($request->users);

        if($group->save()){
            $request->session()->flash('success',  'El grupo \'' . $group->groupName . '\' ha sido modificado correctamente');
        }else{
            $request->session()->flash('error',  'El grupo \'' . $group->groupName . '\' no se podido modificar correctamente');
        }

        return redirect()->action('GroupController@detail',[$group->id]);
    }

    public function create(){
        /*$turns=DB::table('turns')
                    ->join('subjects','turns.subject_id','=','subjects.id')
                    ->select('turns.*','subjects.subjectName')
                    ->orderBy('subjectName')
                    ->get();*/

        $turns = Turn::get();
        $subjects = Subject::get();
        return view('group.group-create',['turns'=> $turns, 'subjects' => $subjects]);
    }

    public function save(Request $request){

        $request->validate([
            'groupName' => 'required|unique:groups|min:2|max:255',
            'description' => 'required|min:2|max:255',
        ]);

        $group = new Group();
        $group->groupName=$request->input('groupName');
        $group->description=$request->input('description');
        $group->turn_id=$request->input('turn');
        $group->image='default.png';
        $group->save();
        if( $request->file('image') !== null && $request->file('image')->isValid()){
            $path='/public/group_img';
            $fileName=$group->id . date('_m_d_y_H_i_s') . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs($path, $fileName);
            $group->image=$fileName;
            $group->save();
        }

        DB::table('group_user')->insert(
            [
                'user_id' => $request->input('groupCreator'), 
                'group_id' => $group->id
            ]
        );

        foreach($request->input('users') as $userId){
            echo $userId . PHP_EOL;
            DB::table('group_user')->insert(
                [
                    'user_id' => (int)$userId, 
                    'group_id' => $group->id
                ]
            );
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
            $user->avgRating=app('App\Http\Controllers\Admin\UsersController')->calculatePuntuations($user->id);
        }
        return view('group.group-detail',['group'=>$group,'turn'=>$turn,'subject'=>$subject,'users'=>$users]);
    }

    public static function getSubject($groupTurnID){ 
        $turn = Turn::find($groupTurnID);
        $subject = Subject::find($turn->subject_id);
        return $subject;
    }
}
