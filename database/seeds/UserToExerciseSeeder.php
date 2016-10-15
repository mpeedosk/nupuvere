<?php

use Illuminate\Database\Seeder;

class UserToExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_to_exercise')->insert([[
            'user_id' => DB::table('users')->where('username', 'mpeedosk')->pluck('id')->first(),
            'ex_id' => DB::table('exercises')->where('title', 'Ülesanne 1')->pluck('id')->first(),
        ], [
            'user_id' => DB::table('users')->where('username', 'mpeedosk')->pluck('id')->first(),
            'ex_id' => DB::table('exercises')->where('title', 'Ülesanne 3')->pluck('id')->first(),
        ]]);
    }
}
