<?php

use Faker\Generator as Faker;
use App\Models\Track;
use Illuminate\Support\Str;

$factory->define(Track::class, function (Faker $faker) {
    $name = $faker->name;
    $path_array = [
        'https://www.nhaccuatui.com/bai-hat/that-girl-olly-murs.b03EguFnAlXU.html',
        'https://www.nhaccuatui.com/bai-hat/beautiful-in-white-shane-filan.6wxzvEkMn8.html',
        'https://www.nhaccuatui.com/bai-hat/fade-dj-prom3t3u-remix-alan-walker.ixSvJ1DKHbLQ.html',
        'https://www.nhaccuatui.com/bai-hat/alone-alan-walker.dPAWTe6nAnZ8.html',
        'https://www.nhaccuatui.com/bai-hat/the-spectre-alan-walker.am558dwdemh1.html',
        'https://www.nhaccuatui.com/bai-hat/tinh-khuc-vang-dan-truong.h2QKRAYBgPwp.html',
        'https://www.nhaccuatui.com/bai-hat/mai-mai-mot-tinh-yeu-dan-truong.voDhhPLuNMDK.html',
        'https://www.nhaccuatui.com/bai-hat/vi-mot-nguoi-ra-di-ung-hoang-phuc.zKsjzttGUaF0.html',
        'https://www.nhaccuatui.com/bai-hat/toi-khong-tin-ung-hoang-phuc.2KSNeWzc4II7.html',
        'https://www.nhaccuatui.com/bai-hat/moi-nguoi-mot-noi-ung-hoang-phuc-ft-thu-thuy.uFiqRQt3aeyd.html',
        'https://www.nhaccuatui.com/bai-hat/set-8x-band.JruY1hS1dAE5.html',
        'https://www.nhaccuatui.com/bai-hat/gia-vo-yeu-ngo-kien-huy.M3mVS7kAIM.html',
        'https://www.nhaccuatui.com/bai-hat/diu-dang-den-tung-phut-giay-quang-vinh.ZWKTp1uItiZb.html',
    ];

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'author' => $faker->firstName,
        'artist_id' => rand(1, 300),
        'user_id' => rand(1, 150),
        'source' => 'nhaccuatui',
        'path' => $path_array[rand(0, 12)],
        'lyric' => $faker->text,
        'week_view' => rand(50, 200),
        'month_view' => rand(500, 1000),
        'views' => rand(5000, 10000),
    ];
});
