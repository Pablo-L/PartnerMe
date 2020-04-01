<?php

use Illuminate\Database\Seeder;
use SebastianBergmann\Environment\Console;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //borramos datos de la tabla
        DB::table('students')->delete();


        $students = factory(App\Student::class, 100)->make();

        for($i = 0; $i < 100; $i++){
            DB::table('students')->insert([
                'phone' => $students[$i]->phone,
                'description' => $students[$i]->description,
                'alias' => $students[$i]->alias,
                'name' => $students[$i]->name,
                'lastName' => $students[$i]->lastName,
                'email' => $students[$i]->email,
                'password' => $students[$i]->password,
                'studies' => $students[$i]->studies,
                'course' => $students[$i]->course,
                'puntuation' => $students[$i]->puntuation,
            ]);
        }

    }
}
