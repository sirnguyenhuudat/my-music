<?php

use Illuminate\Database\Seeder;
use App\Models\Album;
use App\Models\Track;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Album::class, 200)->create()->each(function ($album) {
            $artist_id = $album->artist_id;
            $listTracksByArtist = Track::select('id')->where('artist_id', $artist_id)->get()->toArray();
            $numTracks = count($listTracksByArtist);
            if ($numTracks > 0) {
                $tracks_id = [];
                for ($i = 0; $i <= rand(0, 9); $i++) {
                    if ($i <= $numTracks) {
                        $flag = rand(0, $numTracks - 1);
                        $tracks_id[] = $listTracksByArtist[$flag]['id'];
                    }
                }
                $album->tracks()->sync($tracks_id);
            }
        });
    }
}
