<?php

use Illuminate\Database\Seeder;
use App\Models\Playlist;

class PlaylistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Playlist::class, 50)->create()->each(function ($playlist) {
           $tracks_id = [];
           for ($i = 0; $i <= rand(0, 4); $i++) {
               switch ($i) {
                   case 0:
                       $tracks_id[] = rand(1, 500);
                       break;
                   case 1:
                       $tracks_id[] = rand(501, 1000);
                       break;
                   case 2:
                       $tracks_id[] = rand(1001, 1500);
                       break;
                   case 3:
                       $tracks_id[] = rand(1501, 2000);
                       break;
                   case 4:
                       $tracks_id[] = rand(2001, 2500);
                       break;
                   default:
                       $tracks_id[] = rand(2501, 3000);
                       break;
               }
           }
           $playlist->tracks()->sync($tracks_id);
        });
    }
}
