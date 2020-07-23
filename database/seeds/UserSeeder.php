<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Profile;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1=User::create([
            'name'=>'SRUN VANNARA',
            'admin'=>1,
            'email'=>'srv@gmail.com',
            'password'=>bcrypt('srv@gmail.com')
        ]);
        $user2=User::create([
            'name'=>'SRUN VANNARY',
            'admin'=>0,
            'email'=>'srv2@gmail.com',
            'password'=>bcrypt('srv@gmail.com')
        ]);
        Profile::create([
            'user_id'=>$user1->id,
            'image'=>'', 
            'about'=>'',
           

        ]);
        Profile::create([
            'user_id'=>$user2->id,
            'image'=>'',
            'about'=>'',
           

        ]);

    }
}
