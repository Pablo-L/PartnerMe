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
        DB::table('turns')->insert([
            'classRoomName' => 'clase 1',
            'day' => 'lunes',
            'beginHour' => '09:00:00',
            'endHour' => '11:00:00'
        ]);
    }
}
