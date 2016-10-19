<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ExerciseTableSeeder::class);
        $this->call(AnswersTableSeeder::class);
        $this->call(UserToExerciseSeeder::class);
    }
}
