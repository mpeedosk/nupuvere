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
            // maintaining info
            $table->increments('id');
            $table->timestamps();

            // exercise body
            $table->string('title')->unique();
            $table->text('content');
            $table->integer('type')->unsigned();
            $table->text('hint')->nullable();
            $table->text('solution')->nullable();
            $table->string('author')->nullable();

            // categorization
            $table->string('category');
            $table->string('age_group');
            $table->string('difficulty');

            // statistics
            $table->integer('solved')->unsigned()->default(0);
            $table->integer('attempted')->unsigned()->default(0);

            $table->boolean('licence')->default(true);

            // optional hide feature
            $table->boolean('hidden')->default(false);

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
