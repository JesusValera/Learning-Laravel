<?php

use Faker\Generator as Faker;

$factory->define(App\Profession::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->sentence(3),
    ];
});
