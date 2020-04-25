<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //borramos datos de la tabla
        DB::table('users')->delete();
        DB::table('role_user')->delete();

        $adminRole = Role::where('rolName', 'admin')->first();
        $professorRole = Role::where('rolName', 'professor')->first();
        $studentRole = Role::where('rolName', 'student')->first();

        $numUsers = 100;
        $users = factory(App\User::class, $numUsers)->make();

        for($i = 0; $i < $numUsers; $i++){
            $user = User::create([
                'phone' => $users[$i]->phone,
                'description' => $users[$i]->description,
                'alias' => $users[$i]->alias,
                'name' => $users[$i]->name,
                'lastName' => $users[$i]->lastName,
                'email' => $users[$i]->email,
                'password' => $users[$i]->password,
                'studies' => $users[$i]->studies,
                'course' => $users[$i]->course,
                'puntuation' => $users[$i]->puntuation,
            ]);

            $user->roles()->attach($studentRole);
        }

        $admin = User::create([
            'alias' => '@admin',
            'name' => 'Usuario especial admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('adminadmin'),
        ]);
        $admin->roles()->attach($adminRole);

        $professor = User::create([
            'alias' => '@professor',
            'name' => 'Usuario especial profesor',
            'email' => 'profesor@ua.es',
            'password' => Hash::make('profesorua'),
        ]);
        $professor->roles()->attach($professorRole);


        /*
        for($i = 0; $i < $numUsers; $i++){
            DB::table('users')->insert([
                'phone' => $users[$i]->phone,
                'description' => $users[$i]->description,
                'alias' => $users[$i]->alias,
                'name' => $users[$i]->name,
                'lastName' => $users[$i]->lastName,
                'email' => $users[$i]->email,
                'password' => $users[$i]->password,
                'studies' => $users[$i]->studies,
                'course' => $users[$i]->course,
                'puntuation' => $users[$i]->puntuation,
            ]);
        }*/

    }
}
