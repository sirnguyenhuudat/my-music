<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(GenresTableSeeder::class);
         $this->call(ArtistsTableSeeder::class);
         $this->call(TracksTableSeeder::class);
         $this->call(AlbumsTableSeeder::class);
         $this->call(PlaylistsTableSeeder::class);
         $this->call(CommentsTableSeeder::class);
    }
}
