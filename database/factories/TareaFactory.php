<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Tarea;
use Faker\Generator as Faker;

$factory->define(Tarea::class, function (Faker $faker) {
    return [
        'title' => $faker->company,
        'description' => $faker->paragraph(20),
        'user_id'=>'2'
    ];
});
