<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Eloquent\Contact::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'phone_number' => $faker->randomNumber(9) . rand(0,9)
    ];
});
