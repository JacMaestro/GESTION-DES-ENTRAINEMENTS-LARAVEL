<?php

use App\Roles;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
    public function run()
    {
        if (Roles::count() == 0) { 

            Roles::create([
                'name'           => 'admin', 
                'active_flag' => 1
            ]); 
            Roles::create([
                'name'           => 'player', 
                'active_flag' => 1
            ]); 
    }
    } 
} 
