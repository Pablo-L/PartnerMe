<?php

use Illuminate\Database\Seeder;

class Students_TurnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //borramos datos de la tabla
        DB::table('students_turns')->delete();
        //rellenamos la tabla
        /*DB::table('students_turns')->insert([
            //
        ]);*/
    }
}
