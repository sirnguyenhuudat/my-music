<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 150);
            $table->string('slug');
            $table->string('picture', 250)->nullable();
            $table->string('relate_date');
            $table->text('info')->nullable();
            $table->unsignedInteger('genre_id')->nullable();
            $table->unsignedInteger('artist_id')->nullable();
            $table->unsignedInteger('week_view')->default(0);
            $table->unsignedInteger('month_view')->default(0);
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
    }
}
