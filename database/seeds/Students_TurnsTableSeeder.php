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
        DB::table('student_turn')->delete();
        //rellenamos la tabla
        $turns = DB::table('turns')->get();
        $nTurns = DB::table('turns')->select('id')->count();
        $students = DB::table('students')->get();
        foreach($students as $student){
            DB::table('student_turn')->insert([
                'turn_id' => $turns[random_int(0,$nTurns-1)]->id,
                'student_id' => $student->id
            ]);
        }
    }
}
