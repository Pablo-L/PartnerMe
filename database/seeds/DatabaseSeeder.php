<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StudentsTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(TurnsTableSeeder::class);
        //$this->call(Students_TurnsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(Groups_StudentsTableSeeder::class);
    }
}
