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

            $table->string('title')->unique();
            $table->text('content');
            $table->integer('type')->unsigned();
            $table->text('hint');

            $table->text('solution')->nullable();

            $table->string('category');
            $table->string('age_group');
            $table->string('difficulty');

            $table->integer('solved')->unsigned();
            $table->integer('attempted')->unsigned();
            $table->boolean('hidden');

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
