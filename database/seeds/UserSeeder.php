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
        $user=User::create([
            'name'=>'SRUN VANNARA',
            'admin'=>1,
            'email'=>'srv@gmail.com',
            'password'=>bcrypt('srv@gmail.com')
        ]);
        Profile::create([
            'user_id'=>$user->id,
            'avatar'=>'Link to a pic',
            'about'=>'This is about',
            'facebook'=>'Link to fb account',
            
        ]);

    }
}
