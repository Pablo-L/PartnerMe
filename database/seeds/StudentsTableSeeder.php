<?php

use Illuminate\Database\Seeder;

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
        //rellenamos la tabla
        DB::table('students')->insert([
            'phone' => '1234567890',
            'description' => 'esto es una descripción random...'
        ]);
    }
}
