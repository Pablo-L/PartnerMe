<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'phone' => '603394934',
        'description' => $faker->text,
        'alias' => '@' . $faker->unique()->userName,
        'name' => $faker->name,
        'lastName' => $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => 'qwerty',
        'studies' => 'Grado en ingeniería informática',
        'name' => $faker->name,
        'lastName' => $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => 'qwerty',
        'course' => 3,
    ];
});

