<?php

use Faker\Generator as Faker;

$factory->define(App\Absence::class, function (Faker $faker) {
    return [
        'name' => $faker->Name,
        'work time' => "1",
        
    ];
});
