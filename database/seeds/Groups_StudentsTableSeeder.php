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
        DB::table('group_student')->delete();
        //rellenamos la tabla
        $groups=DB::table('groups')->get();
        $students = DB::table('students')->get();
        $nStudents = DB::table('students')->select('id')->count();
        $i = 0;
        foreach($groups as $group){
            DB::table('group_student')->insert([
                'group_id' => $group->id,
                'student_id' => $students[$i]->id
            ]);
            $i2=$i;
            while($i2==$i){
                $i2=random_int(0,$nStudents-1);
            }
            DB::table('group_student')->insert([
                'group_id' => $group->id,
                'student_id' => $students[$i2]->id
            ]);
            $i3=$i;
            while($i3==$i||$i3==$i2){
                $i3=random_int(0,$nStudents-1);
            }
            DB::table('group_student')->insert([
                'group_id' => $group->id,
                'student_id' => $students[$i3]->id
            ]);
            $i4=$i;
            while($i4==$i||$i4==$i3||$i4==$i2){
                $i4=random_int(0,$nStudents-1);
            }
            DB::table('group_student')->insert([
                'group_id' => $group->id,
                'student_id' => $students[$i4]->id
            ]);
            $i++;
        }
    }
}
