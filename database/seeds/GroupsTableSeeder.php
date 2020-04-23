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
        $users=DB::table('users')->get();
        $turns=DB::table('turns')->get();
        $nTurns=DB::table('turns')->select('id')->count();
        foreach($users as $user){
            DB::table('groups')->insert([
                'groupName' => 'Grupo de ' . $user->alias,
                'description' => '¡Mira, ' . $user->alias . ' tiene un grupo!',
                'image' => 'default.png',
                'turn_id' => $turns[random_int(0,$nTurns-1)]->id
            ]);
        }
    }
}
