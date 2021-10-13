<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationInPlaylistTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playlist_tracks', function (Blueprint $table) {
            $table->foreign('playlist_id')->references('id')->on('playlists')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('track_id')->references('id')->on('tracks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playlist_tracks', function (Blueprint $table) {
            $table->dropForeign('playlist_tracks_playlist_id_foreign');
            $table->dropForeign('playlist_tracks_track_id_foreign');
        });
    }
}
