<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddF3ToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('is_transport')->default(false);
            $table->boolean('is_groups')->default(false);
            $table->boolean('is_outside')->default(false);
            $table->boolean('is_takeawayonly')->default(false);
            $table->boolean('is_studying')->default(false);
            $table->string('social_tripadvisor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            Schema::dropColumn('is_transport');
            Schema::dropColumn('is_groups');
            Schema::dropColumn('is_outside');
            Schema::dropColumn('is_takeawayonly');
            Schema::dropColumn('is_studying');
            Schema::dropColumn('social_tripadvisor');
        });
    }
}
