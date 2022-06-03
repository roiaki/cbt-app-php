<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreeColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threecolumns', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index(); // id -> threecol_idへ変更
            $table->integer('user_id')->unsigned()->index();
            $table->integer('event_id')->unsigned()->index();
           
            $table->string('emotion_name');
            $table->string('emotion_name00')->nullable();
            $table->string('emotion_name01')->nullable();
            $table->string('emotion_name02')->nullable();

            $table->integer('emotion_strength');
            $table->integer('emotion_strength01')->nullable();
            $table->integer('emotion_strength00')->nullable();
            $table->integer('emotion_strength02')->nullable();

            $table->string('thinking', 1000);

            $table->timestamps();

            // 外部キー制約
            // $table->foreign(外部キーを設定するカラム名)->references(制約先のID名)->on(外部キー制約先のテーブル名);
            
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
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
        Schema::dropIfExists('threecolumns');
    }
}
