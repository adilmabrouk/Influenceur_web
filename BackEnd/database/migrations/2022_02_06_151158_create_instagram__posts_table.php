<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstagramPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagram__posts', function (Blueprint $table) {
            $table->id();
            $table->string('like');
            $table->string('comment_count');
            $table->string('views')->nullable();
            $table->string('link_to_post');
            $table->string('caption');
            $table->string('thumbnail_src');
            $table->string('timestamp');
            $table->unsignedBigInteger('instagram_id');
            $table->foreign('instagram_id')->references('id')->on('instagrams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instagram__posts');
    }
}
