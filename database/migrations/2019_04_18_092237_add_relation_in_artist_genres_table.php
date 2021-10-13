<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationInArtistGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artist_genres', function (Blueprint $table) {
            $table->foreign('artist_id')->references('id')->on('artists')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')
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
        Schema::table('artist_genres', function (Blueprint $table) {
            $table->dropForeign('artist_genres_artist_id_foreign');
            $table->dropForeign('artist_genres_genre_id_foreign');
        });
    }
}
