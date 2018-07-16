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

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\Collection::class, function (\Faker\Generator $faker) {
    
    return [
        'category_id' => $faker->numberBetween(1, 6),
        'slug'        => str_slug($faker->word),
        'points'      => $faker->numberBetween(0, 1000),
        'artist'      => $faker->name,
        'created_at'  => $faker->dateTimeBetween('-1 week', 'now'),
        'updated_at'  => $faker->dateTimeBetween('-1 week', 'now')
    ];
    
});

