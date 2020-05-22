<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller{

    //Comprueba si el usuario ha iniciado sesion
    public function __construct(){
        $this->middleware('auth');
    }

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = User::paginate(20);
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function search($search = null, Request $request){
        if($request->ajax()){
            if($search){
                $users = User::where('alias', 'LIKE', '%' . $search . '%')
                    ->orWhere('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->paginate(20);

                $roles = Role::all();
                return view('admin.users.index_data', compact('users', 'roles'));
            }else{
                //$this->index(); no puedo llamarlo porque solo quiero la tabla
                $users = User::paginate(20);
                $roles = Role::all();
                return view('admin.users.index_data', compact('users', 'roles'));
            }
        }
    }

    public function searchUsers($search = null, Request $request, string $specialUser = "notSpecial"){
        if($request->ajax()){
            if($specialUser == "special"){
                $users = User::whereHas('roles', function($q){
                    $q->where('rolName', 'like', 'professor');
                })->where('alias', 'LIKE', '%' . $search . '%')
                ->orWhereHas('roles', function($q){
                    $q->where('rolName', 'like', 'professor');
                })->where('name', 'LIKE', '%' . $search . '%')
                ->get();
                
            }else{
                $users = User::where('alias', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%')
                ->paginate(20);
            }
            $roles = Role::all();
            return view('admin.users.search_result', compact('users', 'roles'));
        }
    }

    public function fetchData(Request $request){
        if($request->ajax()){
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');

            $users = User::orderBy($sort_by, $sort_type)->paginate(20);
            //$users = DB::table('users')->orderBy($sort_by, $sort_type)->paginate(20);
            return view('admin.users.index_data', compact('users'))->render();
        }
    }

    public function getUsers(){
        $users = User::all('id', 'name');
        return json_encode($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user){

        $puntuation = $this->calculatePuntuations($user->id);
        $user->puntuation = $puntuation;
        $user->save();

        $groups = $user->groups;
        return view('admin.users.detail',[
            'user' => $user,
            'groups' => $groups
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user){
        //Compruebo si el ususrio tiene los permisos para editar, si no lo redirigo al inicio
        if(Gate::denies('edit-users', Auth::user(), $user)){
            return redirect(route('admin.users.index'));
        }
        
        $roles = Role::all();

        return view('auth.register')->with([
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user){
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastName' => ['nullable','string', 'max:255'],
            'alias' => ['required', 'string', 'max:255', 'unique:users,' . 'alias,' . $user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,' . 'email,' . $user->id],
            'phone' => ['nullable','numeric'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'studies' => ['required', 'string'],
            'course' => ['nullable','numeric', 'between:0,4'],
            'description' => ['nullable','string', 'max:4096'],
        ]);

        $user->roles()->sync($request->roles);

        $user->phone = $request->phone;
        $user->description = $request->description;
        $user->alias = $request->alias;
        $user->name = $request->name;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->studies = $request->studies;
        $user->course = $request->course;

        if( $request->file('image') !== null && $request->file('image')->isValid()){
            $path='/public/user_img';
            $fileName = $user->id . date('_m_d_y_H_i_s') . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs($path, $fileName);
            $user->image = '/storage/user_img/' . $fileName;
        }

        if($user->save()){
            $request->session()->flash('success',  'El usuario ' . $request->input('alias') . ' ha sido modificado correctamente');
        }else{
            $request->session()->flash('error',  'El usuario ' . $request->input('alias') . ' no se pudo modificar');
        }

        return redirect()->route('admin.users.index');
    }

    public function delete($id, Request $request){

        $user = User::find($id);
        $alias = $user->alias;

        if(Gate::denies('delete-users', $user)){
            return response()->json(['status'=>'El usuario ' . $alias . ' no se pudo borrar, permiso denegado']);
        }
        
        $user->roles()->detach();
        //$user->received_ratings()->detach();
        //$user->received_created()->detach();

        if($user->delete()){
            return response()->json(['status'=>'El usuario ' . $alias . ' ha sido borrado correctamente']);
        }else{
            return response()->json(['status'=>'El usuario \'' . $alias . '\' no se ha podido borrar']);
        }

        
    }

    public function deleteSearch($id, Request $request){
        $user = User::find($id);
        $alias = $user->alias;

        if(Gate::denies('delete-users', $user)){
            $request->session()->flash('error',  'El usuario ' . $alias . ' no se pudo eliminar');
            return;
        }

        if($user->delete()){
            $request->session()->flash('success',  'El usuario ' . $alias . ' ha sido eliminado correctamente');
            return redirect()->action('Admin\UsersController@index')->with('message','Operación realizada correctamente');
            //return Redirect::back();
        }else{
            $request->session()->flash('error',  'El usuario ' . $alias . ' no se pudo eliminar');
            return Redirect::back()->with('message','Operación NO realizada');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user){
        /*
        $alias = $user->alias;

        $user->roles()->detach();
        //$user->received_ratings()->detach();
        //$user->received_created()->detach();
        
        $user->delete();
        return redirect()->route('admin.users.index');
        */
    }
}
