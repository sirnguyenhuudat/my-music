<?php

use Illuminate\Database\Seeder;
use App\Models\Artist;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Artist::class, 300)->create()->each(function ($artist) {
            $genres_id = [];
            for ($i = 0; $i <= rand(0, 3); $i++) {
                if ($i == 0) {
                    $genres_id[] = rand(1, 7);
                }
                if ($i == 1) {
                    $genres_id[] = rand(8, 14);
                }
                if ($i == 2) {
                    $genres_id[] = rand(15, 20);
                }
            }
            $artist->genres()->sync($genres_id);
        });;
    }
}
