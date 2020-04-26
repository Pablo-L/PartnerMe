<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UsersController extends Controller{

    public function __construct(){
        $this->middleware('auth');
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

    public function fetchData(Request $request){
        if($request->ajax()){
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');

            $users = User::orderBy($sort_by, $sort_type)->paginate(20);
            //$users = DB::table('users')->orderBy($sort_by, $sort_type)->paginate(20);
            return view('admin.users.index_data', compact('users'))->render();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user){
        //Compruebo si el ususrio tiene los permisos para editar, si no lo redirigo al inicio
        if(Gate::denies('edit-users')){
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
        $id = $request->input('id');
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastName' => ['nullable','string', 'max:255'],
            'alias' => ['required', 'string', 'max:255', 'unique:users,' . 'alias,' . $id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,' . 'email,' . $id],
            'phone' => ['nullable','numeric'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'studies' => ['required', 'string'],
            'course' => ['nullable','numeric', 'between:0,4'],
            'description' => ['nullable','string', 'max:4096'],
        ]);

        $user->roles()->sync($request->roles);

		$user = DB::table('users')->where('id', $id)
			->update(array(
                'phone' => $request->input('phone'),
                'description' => $request->input('description'),
                'alias' => $request->input('alias'),
                'name' =>  $request->input('name'),
                'lastName' =>  $request->input('lastName'),
                'email' =>  $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'studies' =>  $request->input('degree'),
                'course' =>  $request->input('course'),
			));
        return redirect()->route('admin.users.index')
            ->with('status', 'El usuario ' . $request->input('alias') . ' ha sido modificado correctamente');
    }

    /*Uso delete para usar AJAX*/
    public function delete($id){

        $user = User::find($id);
        $alias = $user->alias;

        if(Gate::denies('delete-users', $user)){
            return response()->json(['status'=>'El usuario ' . $alias . ' no se pudo borrar, permiso denegado']);
        }
        
        $user->roles()->detach();
        //$user->received_ratings()->detach();
        //$user->received_created()->detach();

        $user->delete();

        return response()->json(['status'=>'El usuario ' . $alias . ' ha sido borrado correctamente']);
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
