<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //borramos datos de la tabla
        DB::table('subjects')->delete();
        //rellenamos la tabla
        DB::table('subjects')->insert([
            'subjectName' => 'asignatura x',
            'department' => 'un dpto cualquiera...'
        ]);
    }
}
