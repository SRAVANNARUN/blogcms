<?php

use Illuminate\Database\Seeder;

class MainmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Mainmenu::class, 7)->create()->each(function($m) {
            for ($i=0; $i <2 ; $i++) { 
                $m->submenus()->save(factory(App\Submenu::class)->make());
            }
          });
    }
}
