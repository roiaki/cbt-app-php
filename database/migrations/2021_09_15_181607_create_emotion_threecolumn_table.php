<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmotionThreecolumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emotion_threecolumn', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('threecol_id')->unsigned()->index();
            $table->integer('emotion_id')->unsigned()->index();

            $table->timestamps();

            $table->unique(['threecol_id', 'emotion_id']);

            // 外部キー制約
            $table->foreign('threecol_id')->references('id')->on('threecolumns')->onDelete('cascade');
            $table->foreign('emotion_id')->references('id')->on('emotions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emotion_threecolumn');
    }
}
