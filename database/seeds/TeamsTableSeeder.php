<?php

use App\Roles;
use App\Teams;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
    public function run()
    {
        if (Teams::count() == 0) { 

            Teams::create([
                'name'           => 'As Craponne', 
                'active_flag' => 1
            ]); 
    }
    } 
} 
