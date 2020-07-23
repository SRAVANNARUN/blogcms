<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'product_name' => $faker->word,
        'price'=>$faker->numberBetween(100,1000),
        'slug'=>'slug_title',
        'product_detail' => $faker->paragraph(100),
        'image' =>'posts/Fp2SutxtRbTzhlovxvSDOIwx0dimaRKijnQIsrXD.jpeg',
        'submenu_id' => $faker->numberBetween(1,14),
    ];
});
