<?php

use Illuminate\Database\Seeder;

class Groups_StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //borramos datos de la tabla
        DB::table('groups_students')->delete();
        //rellenamos la tabla
        $student;
        $groups=DB::table('groups')->get();
        $id=1;
        foreach($groups as $group){
            $student=DB::table('students')->where('id',$id)->first();
            DB::table('groups_students')->insert([
                'groups_id' => $group->id,
                'students_id' => $student->id
            ]);
            $id++;
        }
    }
}
