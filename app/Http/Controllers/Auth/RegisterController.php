<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Role;
use App\Rules\AliasValidation;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'alias' => ['required', 'string', 'max:255', new AliasValidation],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'numeric'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'studies' => ['required', 'string'],
            'course' => ['required', 'numeric', 'between:0,4'],
            'description' => ['nullable', 'string', 'max:4096'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data){

        $user = User::create([
            'name' => $data['name'],
            'lastName' => $data['lastName'],
            'alias' => '@' . $data['alias'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'studies' => $data['studies'],
            'course' => $data['course'],
            'description' => $data['description'],
            'image' => '/storage/user_img/default.png',
        ]);

        $request = request();

        if( $request->file('image') !== null && $request->file('image')->isValid()){
            $path='/public/user_img';
            $fileName = $user->id . date('_m_d_y_H_i_s') . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs($path, $fileName);
            $user->image = '/storage/user_img/' . $fileName;
        }

        
        $role = Role::select('id')->where('rolName', 'student')->first();
        $user->roles()->attach($role);
        
        $user->save();
        return $user;

    }
}
