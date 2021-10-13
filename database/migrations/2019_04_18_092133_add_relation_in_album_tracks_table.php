<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationInAlbumTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('album_tracks', function (Blueprint $table) {
            $table->foreign('track_id')->references('id')->on('tracks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('album_id')->references('id')->on('albums')
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
        Schema::table('album_tracks', function (Blueprint $table) {
            $table->dropForeign('album_tracks_track_id_foreign');
            $table->dropForeign('album_tracks_album_id_foreign');
        });
    }
}
