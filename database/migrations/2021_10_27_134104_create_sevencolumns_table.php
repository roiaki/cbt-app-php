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
            $table->string('basis_thinking', 500); // 変更したので再マイグレーション
            $table->string('opposite_fact', 500);
            $table->string('new_thinking', 500);

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
    
    Schema::create('newemotions', function (Blueprint $table) {
        $table->increments('id')->unsigned()->index();
        $table->integer('user_id')->unsigned();
        $table->integer('event_id')->unsigned();
        $table->integer('threecolumn_id')->unsigned();
        $table->integer('sevencolumn_id')->unsigned();
        
        $table->string('new_emotion_name', 30);
        $table->integer('new_emotion_strength');
        $table->timestamps();

        $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        
        $table->foreign('event_id')
            ->references('id')
            ->on('events')
            ->onDelete('cascade');

        $table->foreign('threecolumn_id')
            ->references('id')
            ->on('threecolumns')
            ->onDelete('cascade');

        $table->foreign('sevencolumn_id')
            ->references('id')
            ->on('sevencolumns')
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
        Schema::dropIfExists('sevencolumns');
        Schema::dropIfExists('newemotions');
    }
}

