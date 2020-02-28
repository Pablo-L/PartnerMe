<?php

use Illuminate\Database\Seeder;

class TurnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //borramos datos de la tabla
        DB::table('turns')->delete();
        //rellenamos la tabla
        $subject = DB::table('subjects')->where('subjectName','Estadística')->first();
        DB::table('turns')->insert([
            'classRoomName' => 'L02',
            'day' => 'Lunes',
            'beginHour' => '13:00:00',
            'endHour' => '15:00:00',
            'subject_id' => $subject->id
        ]);
        $subject = DB::table('subjects')->where('subjectName','Programación 1')->first();
        DB::table('turns')->insert([
            'classRoomName' => 'L24',
            'day' => 'Martes',
            'beginHour' => '09:00:00',
            'endHour' => '11:00:00',
            'subject_id' => $subject->id
        ]);
        $subject = DB::table('subjects')->where('subjectName','Matemáticas 1')->first();
        DB::table('turns')->insert([
            'classRoomName' => 'L21',
            'day' => 'Jueves',
            'beginHour' => '11:00:00',
            'endHour' => '13:00:00',
            'subject_id' => $subject->id
        ]);
        $subject = DB::table('subjects')->where('subjectName','Sistemas operativos')->first();
        DB::table('turns')->insert([
            'classRoomName' => 'L14',
            'day' => 'Viernes',
            'beginHour' => '15:00:00',
            'endHour' => '17:00:00',
            'subject_id' => $subject->id
        ]);
    }
}
