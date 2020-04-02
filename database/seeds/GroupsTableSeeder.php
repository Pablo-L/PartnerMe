<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //borramos datos de la tabla
        DB::table('groups')->delete();
        //rellenamos la tabla
        $students=DB::table('students')->get();
        $turn = DB::table('turns')->first();
        foreach($students as $student){
            DB::table('groups')->insert([
                'groupName' => 'Grupo de ' . $student->alias,
                'description' => '¡Mira, ' . $student->alias . ' tiene un grupo!',
                'image' => 'none (por ahora)',
                'turn_id' => $turn->id
            ]);
        }
    }
}
