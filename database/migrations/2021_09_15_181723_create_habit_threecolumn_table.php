<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitThreecolumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habit_threecolumn', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('threecol_id')->unsigned()->index();
            $table->integer('habit_id')->unsigned()->index();

            $table->timestamps();

            $table->unique(['threecol_id', 'habit_id']);

            // 外部キー制約
            $table->foreign('threecol_id')->references('id')->on('threecolumns')->onDelete('cascade');
            $table->foreign('habit_id')->references('id')->on('habits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('habit_threecolumn');
    }
}
