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
        $subjects=DB::table('subjects')->get();
        $days=['Lunes','Martes','Miércoles','Jueves','Viernes'];
        foreach($subjects as $subject){
            for($i=0;$i<5;$i++){
                $bH=random_int(8,19);
                $eH=$bH+2;
                if($bH==8||$bH==9){
                    $bH='0' . $bH;
                }
                DB::table('turns')->insert([
                    'classRoomName' => 'L' . random_int(0,9) . random_int(0,9),
                    'day' => $days[random_int(0,4)],
                    'beginHour' => $bH . ':00:00',
                    'endHour' => $eH. ':00:00',
                    'subject_id' => $subject->id
                ]);
            }
        }
    }
}
