<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;
use App\User;

class UserController extends Controller{


    public function calculatePuntuations($id){
        $user = User::find($id);
        $puntuations = $user->received_ratings;
        
        $totalPuntuation = 0.0;

        foreach($puntuations as $puntuation){
            $totalPuntuation += $puntuation->points;
        }
        
        $averagePuntuation = ( $totalPuntuation / (count($puntuations) > 0 ? count($puntuations) : 1));        
        return $averagePuntuation;
    }

    public function index(){
        //$users = DB::table('users')->paginate(20);
        //return view('user.users-list', [
        //    'users' => $users
        //]);
        //$users = User::all()
        
        $users = DB::table('users')->paginate(20);
        //foreach($users as $user){$user->puntuation = $this->calculatePuntuations($user->id);}
        return view('user.users-list', compact('users'));
    }

    function fetch_data(Request $request){
       
        if($request->ajax()){
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');

            $users = DB::table('users')->orderBy($sort_by, $sort_type)->paginate(20);
            return view('user.users-list-data', compact('users'))->render();
        }
    }

    public function detail($alias){
        $user = DB::table('users')->where('alias', $alias)->first();
        $puntuation = $this->calculatePuntuations($user->id);
        $user->puntuation = $puntuation;

        $s = User::find($user->id);
        $groups = $s->groups;
        return view('user.user-detail',[
            'user' => $user,
            'groups' => $groups
		]);
    }

    public function delete($alias){

        $user = DB::table('users')->where('alias', $alias)->first();
        //Eliminamos todos los ratings creados y recibidos por el ususario
        DB::table('ratings')->where('user_id_creator', $user->id)->delete();
        DB::table('ratings')->where('user_id_receiver', $user->id)->delete();

        DB::table('users')->where('id', $user->id)->delete();
		//return redirect()->action('UserController@index')->with('status', 'El estudiante ' . $alias . ' ha sido borrado correctamente');
        return response()->json(['status'=>'El estudiante ' . $alias . ' ha sido borrado correctamente']);
    }

    public function edit($alias){
		$user = DB::table('users')->where('alias', $alias)->first();
		
		return view('signup',[
			'user' => $user
		]);
    }

    public function update(Request $request){
		$id = $request->input('id');
		
		$user = DB::table('users')->where('id', $id)
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
        return redirect()->action('UserController@index')
            ->with('status', 'El estudiante ' . $request->input('alias') . ' ha sido modificado correctamente');
    }

    public function save(Request $request){
        $user = DB::table('users')->insert(array(
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
		
        return redirect()->action('UserController@index')
            ->with('status', 'El estudiante ' . "@" . $request->input('alias') . ' ha sido creado correctamente');
    }

}
