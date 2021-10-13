<?php

use Faker\Generator as Faker;
use App\Models\Artist;
use Illuminate\Support\Str;

$factory->define(Artist::class, function (Faker $faker) {
    $name = $faker->name;

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'avatar' => null,
        'year_active' => rand(1, 20),
        'info' => $faker->paragraph,
    ];
});
