<?php

use Illuminate\Database\Seeder;
use App\Models\Track;

class TracksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Track::class, 3000)->create()->each(function ($track) {
            $genres_id = [];
            for ($i = 0; $i <= rand(0, 2); $i++) {
                if ($i == 0) {
                    $genres_id[] = rand(1, 6);
                }
                if ($i == 1) {
                    $genres_id[] = rand(7, 13);
                }
                if ($i == 2) {
                    $genres_id[] = rand(14, 20);
                }
            }
            $track->genres()->sync($genres_id);
        });;
    }
}
