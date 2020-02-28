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
        $subject = DB::table('subjects')->where('subjectName','Sistemas operativos')->first();
        $turn = DB::table('turns')->where('subject_id',$subject->id)->first();
        $student = DB::table('students')->where('phone','+34112893389')->first();
        DB::table('students_turns')->insert([
            'turns_id' => $turn->id,
            'students_id' => $student->id
        ]);
        $subject = DB::table('subjects')->where('subjectName','Matemáticas 1')->first();
        $turn = DB::table('turns')->where('subject_id',$subject->id)->first();
        $student = DB::table('students')->where('phone','+34961967275')->first();
        DB::table('students_turns')->insert([
            'turns_id' => $turn->id,
            'students_id' => $student->id
        ]);
        $subject = DB::table('subjects')->where('subjectName','Programación 1')->first();
        $turn = DB::table('turns')->where('subject_id',$subject->id)->first();
        $student = DB::table('students')->where('phone','+34781905180')->first();
        DB::table('students_turns')->insert([
            'turns_id' => $turn->id,
            'students_id' => $student->id
        ]);
        $subject = DB::table('subjects')->where('subjectName','Matemáticas 1')->first();
        $turn = DB::table('turns')->where('subject_id',$subject->id)->first();
        $student = DB::table('students')->where('phone','+34031286307')->first();
        DB::table('students_turns')->insert([
            'turns_id' => $turn->id,
            'students_id' => $student->id
        ]);
        $subject = DB::table('subjects')->where('subjectName','Estadística')->first();
        $turn = DB::table('turns')->where('subject_id',$subject->id)->first();
        $student = DB::table('students')->where('phone','+34152042041')->first();
        DB::table('students_turns')->insert([
            'turns_id' => $turn->id,
            'students_id' => $student->id
        ]);
        $subject = DB::table('subjects')->where('subjectName','Estadística')->first();
        $turn = DB::table('turns')->where('subject_id',$subject->id)->first();
        $student = DB::table('students')->where('phone','+34438898335')->first();
        DB::table('students_turns')->insert([
            'turns_id' => $turn->id,
            'students_id' => $student->id
        ]);
    }
}
