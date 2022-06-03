<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSevencolumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sevencolumns', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('event_id')->unsigned()->index();
            $table->integer('threecol_id')->unsigned()->index();

            $table->string('basis_thinking');
            $table->string('opposite_fact');
            $table->string('new_thinking');

            $table->string('new_emotion_name');
            $table->string('new_emotion_name00')->nullable();;
            $table->string('new_emotion_name01')->nullable();;
            $table->string('new_emotion_name02')->nullable();;

            $table->integer('new_emotion_strength');
            $table->integer('new_emotion_strength00')->nullable();;
            $table->integer('new_emotion_strength01')->nullable();;
            $table->integer('new_emotion_strength02')->nullable();;

            $table->timestamps();

            // 外部キー制約
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');

            $table->foreign('threecol_id')
                ->references('id')
                ->on('threecolumns')
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
        Schema::dropIfExists('messages');
    }
}
