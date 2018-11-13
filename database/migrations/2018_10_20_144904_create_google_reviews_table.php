<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoogleReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author_name');
            $table->string('author_url');
            $table->string('language');
            $table->string('profile_photo_url');
            $table->string('rating');
            
            $table->string('relative_time_description');
            $table->text('text');
            $table->string('time');
            $table->integer('place_id');
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
        Schema::dropIfExists('google_reviews');
    }
}
