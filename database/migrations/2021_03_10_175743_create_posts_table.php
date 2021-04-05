<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');               //post id
            $table->integer('userId'); //owner of post
            //$table->integer('postID');
            $table->string('post_contant'); //caption
            $table->integer('total_likes');
            $table->integer('total_comments');  
            $table->dateTime('date_created');
            $table->dateTime('date_updated');
            $table->string('image_path');
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
        Schema::dropIfExists('posts');
    }
}
