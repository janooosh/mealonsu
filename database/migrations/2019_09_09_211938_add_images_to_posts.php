<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImagesToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('img_1')->nullable();
            $table->string('img_2')->nullable();
            $table->string('img_3')->nullable();
            $table->string('img_4')->nullable();
            $table->string('img_5')->nullable();
            $table->string('img_6')->nullable();
            $table->string('img_title')->nullable();
            $table->string('img_logo')->nullable();
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
            Schema::dropColumn('img_1');
            Schema::dropColumn('img_2');
            Schema::dropColumn('img_3');
            Schema::dropColumn('img_4');
            Schema::dropColumn('img_5');
            Schema::dropColumn('img_6');
            Schema::dropColumn('img_title');
            Schema::dropColumn('imt_logo');
        });
    }
}
