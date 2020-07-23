<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Submenu;
use Faker\Generator as Faker;

$factory->define(Submenu::class, function (Faker $faker) {
    return [
        'submenu' => $faker->name,
        'mainmenu_id'=>$faker->numberBetween(1,14),
    ];
});
