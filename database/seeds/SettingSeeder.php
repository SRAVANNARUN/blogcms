<?php

use Illuminate\Database\Seeder;
use App\Setting;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'site_name'=>'My site name',
            'contact_number'=>'My contact number',
            'contact_email'=>'My contact email',
            'contact_address'=> 'My contact address'
        ]);
    }
}
