<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Program;
use Faker\Generator as Faker;

$factory->define(Program::class, function (Faker $faker) {
    return [
        'ProgramHead' => $faker->name,
        'College' => $faker->jobTitle,
        'ProgramName' => $faker->jobTitle,
        'Description' => $faker->text

    ];
});
