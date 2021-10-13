<?php

use Faker\Generator as Faker;
use App\Models\Playlist;
use Illuminate\Support\Str;

$factory->define(Playlist::class, function (Faker $faker) {
    $title = $faker->name;

    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'user_id' => rand(1, 150),
    ];
});
