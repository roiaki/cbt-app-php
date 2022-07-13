<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // @check 後で別テーブルへ検討 
        Schema::create('solutions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->index();
            $table->string('trouble', 500);
            $table->string('solution00', 500);
            $table->string('solution01', 500)->nullable();
            $table->string('solution02', 500)->nullable();
            $table->string('solution03', 500)->nullable();
            $table->string('solution04', 500)->nullable();
            $table->string('merit00', 500);
            $table->string('merit01', 500)->nullable();
            $table->string('merit02', 500)->nullable();
            $table->string('merit03', 500)->nullable();
            $table->string('merit04', 500)->nullable();
            $table->string('demerit00', 500);
            $table->string('demerit01', 500)->nullable();
            $table->string('demerit02', 500)->nullable();
            $table->string('demerit03', 500)->nullable();
            $table->string('demerit04', 500)->nullable();
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
        Schema::dropIfExists('solutions');
    }
}
