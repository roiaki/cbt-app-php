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
        Schema::create('troubles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('trouble', 500);
            
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            
        });

        Schema::create('solutions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('trouble_id')->unsigned()->index();
            $table->string('solution', 500);
            
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('trouble_id')
                ->references('id')
                ->on('troubles')
                ->onDelete('cascade');
        });

        Schema::create('merits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('trouble_id')->unsigned()->index();
            $table->string('merit', 500);
            
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('trouble_id')
                ->references('id')
                ->on('troubles')
                ->onDelete('cascade');
        });

        Schema::create('demerits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('trouble_id')->unsigned()->index();
            $table->string('demerit', 500);
            
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->foreign('trouble_id')
                ->references('id')
                ->on('troubles')
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
        Schema::dropIfExists('troubles');
        Schema::dropIfExists('solutions');
        Schema::dropIfExists('merit');
        Schema::dropIfExists('demerit');
    }
}
