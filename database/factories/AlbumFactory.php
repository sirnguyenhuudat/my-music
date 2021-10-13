<?php

use Faker\Generator as Faker;
use App\Models\Album;
use Illuminate\Support\Str;

$factory->define(Album::class, function (Faker $faker) {
    $name = $faker->name;

    return [
        'title' => $name,
        'slug' => Str::slug($name),
        'picture' => null,
        'relate_date' => $faker->dateTimeBetween('-5 years', 'now'),
        'info' => $faker->text,
        'genre_id' => rand(1, 20),
        'artist_id' => rand(1, 300),
        'week_view' => rand(1, 200),
        'month_view' => rand(500, 1000),
        'views' => rand(1001, 5000),
    ];
});
