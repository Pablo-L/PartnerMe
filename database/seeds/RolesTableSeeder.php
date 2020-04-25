<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        
        DB::table('roles')->delete();
        
        Role::create(['rolName' => 'admin']);
        Role::create(['rolName' => 'professor']);
        Role::create(['rolName' => 'student']);

    }
}
