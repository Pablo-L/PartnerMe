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
        $users = DB::table('users')->get();
        
        $numUsers = count($users);
        $i=1;
        foreach($users as $user){
            DB::table('ratings')->insert([
                'user_id_creator' => $users[$numUsers - $i]->id,
                'user_id_receiver' => $user->id,
                'points' => (double) mt_rand(0,100) / 10.0,
                'comment' => $faker->text,
            ]);
            $i++;
        }
        //DB::table('ratings')->insert();



    }
}
