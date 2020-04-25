<?php

use App\Role;
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
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(TurnsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        
        $this->call(Groups_UsersTableSeeder::class);
    }
}
