<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Instructor;
use Faker\Generator as Faker;

$factory->define(Instructor::class, function (Faker $faker) {
    return [
        'InstructorFirstName' => $faker->firstName,
        'InstructorLastName' => $faker->lastName,
        'InstructorEmail' => $faker->email,
        'InstructorPhone' => $faker->phoneNumber,
        'DegreeEarned' => $faker->jobTitle,
        'DegreeSchool' => $faker->lastName,
        'Description' => $faker->text,
        'Admin' => 1,
    ];
});
