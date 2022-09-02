<?php

use App\Players;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Players::count() == 0) { 

            Players::create([
                'firstname'           => 'Super',
                'lastname'           => 'Admin',
                'phone'           => '+33 000 000 00',
                'email'          => 'contact@ascraponne.fr',
                'password'       => Hash::make(123456789),  
                'active_flag' => 1,
                'team_id' => 1,
                'role_id' => 1
            ]); 
            Players::create([
                'firstname'           => 'Joeur',
                'lastname'           => 'J',
                'phone'           => '+33 000 000 00',
                'email'          => 'ex@ex.fr',
                'password'       => Hash::make(123456789),  
                'active_flag' => 1,
                'team_id' => 1,
                'role_id' => 2
            ]); 
    }
    }
}
