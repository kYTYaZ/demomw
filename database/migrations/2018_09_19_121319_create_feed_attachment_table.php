<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('site');
            $table->string('title');
            $table->integer('type');
            $table->string('url');
            $table->integer('feed_id');
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
        Schema::dropIfExists('feed_attachment');
    }
}
