<?php

use Illuminate\Database\Seeder;

class Groups_UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //borramos datos de la tabla
        DB::table('group_user')->delete();
        //rellenamos la tabla
        $groups=DB::table('groups')->get();
        $users = DB::table('users')->get();
        $nusers = DB::table('users')->select('id')->count();
        $i = 0;
        foreach($groups as $group){
            DB::table('group_user')->insert([
                'group_id' => $group->id,
                'user_id' => $users[$i]->id
            ]);
            $i2=$i;
            while($i2==$i){
                $i2=random_int(0,$nusers-1);
            }
            DB::table('group_user')->insert([
                'group_id' => $group->id,
                'user_id' => $users[$i2]->id
            ]);
            $i3=$i;
            while($i3==$i||$i3==$i2){
                $i3=random_int(0,$nusers-1);
            }
            DB::table('group_user')->insert([
                'group_id' => $group->id,
                'user_id' => $users[$i3]->id
            ]);
            $i4=$i;
            while($i4==$i||$i4==$i3||$i4==$i2){
                $i4=random_int(0,$nusers-1);
            }
            DB::table('group_user')->insert([
                'group_id' => $group->id,
                'user_id' => $users[$i4]->id
            ]);
            $i++;
        }
    }
}
