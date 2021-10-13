<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationInGenreTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('genre_tracks', function (Blueprint $table) {
            $table->foreign('genre_id')->references('id')->on('genres')
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
        Schema::table('genre_tracks', function (Blueprint $table) {
            $table->dropForeign('genre_tracks_genre_id_foreign');
            $table->dropForeign('genre_tracks_track_id_foreign');
        });
    }
}
