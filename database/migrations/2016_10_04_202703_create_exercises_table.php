<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('title');
            $table->text('content');
            $table->integer('type')->unsigned();
            $table->string('hint');

//            $table->json('answers');

            $table->string('answer');

            $table->string('category');
            $table->foreign('category')->references('name')->on('categories');
            $table->string('age_group');
            $table->string('difficulty');

            $table->integer('solved')->unsigned();
            $table->integer('attempted')->unsigned();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercises');
    }
}
