<?php

use Illuminate\Database\Seeder;

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


        $users = factory(App\User::class, 100)->make();

        for($i = 0; $i < 100; $i++){
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
        }

    }
}
