<?php

use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        DB::table('ratings')->delete();

        $faker = Faker\Factory::create();
        $students = DB::table('students')->get();
        
        $numStudents = count($students);
        $i=1;
        foreach($students as $student){
            DB::table('ratings')->insert([
                'student_id_creator' => $students[$numStudents - $i]->id,
                'student_id_receiver' => $student->id,
                //'student_id' => $student->id,
                'points' => (float) mt_rand(0,100) / 10.0,
                'comment' => $faker->text,
            ]);
            $i++;
        }
        //DB::table('ratings')->insert();



    }
}
