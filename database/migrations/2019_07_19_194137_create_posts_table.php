<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->timestamps();
            //$table->boolean('is_published');
            $table->integer('user_id');
            $table->string('restaurant_name');
            $table->string('subtitle')->nullable();
            $table->integer('pricerange')->nullable();
            $table->boolean('is_vegan')->nullable();
            $table->boolean('is_vegetarian')->nullable();
            $table->boolean('is_date')->nullable();
            $table->string('url_homepage')->nullable();
            $table->string('url_menu')->nullable();
            $table->string('url_reservation')->nullable();
            $table->string('url_delivery')->nullable();
            $table->string('social_facebook')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_twitter')->nullable();
            $table->text('summary')->nullable();
            $table->text('review_food')->nullable();
            $table->text('review_style')->nullable();
            $table->text('review_service')->nullable();
            $table->boolean('is_draft')->default(1);
            $table->boolean('is_approved')->default(0);
            $table->boolean('is_declined')->default(0);
            $table->integer('review_id')->nullable();
            $table->integer('correction_id')->nullable(); //If a post got corrected by an editor, stick a reference to this correction here
            $table->string('place_name')->nullable();
            $table->string('place_adress')->nullable();
            $table->string('place_location')->nullable();
            $table->string('place_icon')->nullable();
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
