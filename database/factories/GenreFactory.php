<?php

use Faker\Generator as Faker;
use App\Models\Genre;
use Illuminate\Support\Str;

$factory->define(Genre::class, function (Faker $faker) {
    $name = $faker->name;

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'description' => $faker->text,
        'picture' => null,
    ];
});
