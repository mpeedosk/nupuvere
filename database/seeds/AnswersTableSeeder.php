<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([[
            'ex_id' => DB::table('exercises')->where('title', 'Ülesanne 1')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => '225g',
            'is_correct' => true,
            'order' => 0

        ], [
            'ex_id' => DB::table('exercises')->where('title', 'Ülesanne 4')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'Aadul on kotis 6 õpikut.',
            'is_correct' => true,
            'order' => 0

        ], [
            'ex_id' => DB::table('exercises')->where('title', 'Ülesanne 2')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'Aadul on kotis 6 õpikut.',
            'is_correct' => true,
            'order' => 0

        ], [
            'ex_id' => DB::table('exercises')->where('title', 'Ülesanne 3')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'See kahekohaline arv on 49.',
            'is_correct' => true,
            'order' => 0
        ], [
            'ex_id' => DB::table('exercises')->where('title', 'Üks õige vastus')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'Ilves',
            'is_correct' => false,
            'order' => 0
        ], [
            'ex_id' => DB::table('exercises')->where('title', 'Üks õige vastus')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'Tiiger',
            'is_correct' => false,
            'order' => 1
        ], [
            'ex_id' => DB::table('exercises')->where('title', 'Üks õige vastus')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'Karu',
            'is_correct' => true,
            'order' => 2
        ], [
            'ex_id' => DB::table('exercises')->where('title', 'Üks õige vastus')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'Kass',
            'is_correct' => false,
            'order' => 3
        ], [
            'ex_id' => DB::table('exercises')->where('title', 'Mitu õiget varianti')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'Koer',
            'is_correct' => true,
            'order' => 0
        ], [
            'ex_id' => DB::table('exercises')->where('title', 'Mitu õiget varianti')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'Ahven',
            'is_correct' => false,
            'order' => 1
        ], [
            'ex_id' => DB::table('exercises')->where('title', 'Mitu õiget varianti')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'Ilves',
            'is_correct' => true,
            'order' => 2
        ], [
            'ex_id' => DB::table('exercises')->where('title', 'Mitu õiget varianti')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'Pääsuke',
            'is_correct' => false,
            'order' => 3
        ], [
            'ex_id' => DB::table('exercises')->where('title', 'Järjestamine')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'Mootorratas',
            'is_correct' => true,
            'order' => 0
        ], [
            'ex_id' => DB::table('exercises')->where('title', 'Järjestamine')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'Auto',
            'is_correct' => true,
            'order' => 1
        ], [
            'ex_id' => DB::table('exercises')->where('title', 'Järjestamine')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'Lennuk',
            'is_correct' => true,
            'order' => 2
        ], [
            'ex_id' => DB::table('exercises')->where('title', 'Järjestamine')->pluck('id')->first(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'Kruiisilaev',
            'is_correct' => true,
            'order' => 3
        ]]);


        $count = DB::table('exercises')->get()->count();
        $faker = Faker\Factory::create();

        for ($i = 0; $i < $count * 3; $i++) {
            \App\Answer::create([
                'ex_id' => floor($i/3)*10 + 2,
//                'ex_id' => floor($i/3) + 1,
                'content' => $faker->sentence(3),
                'is_correct' => $faker->boolean($chanceOfGettingTrue = 50),
                'order' => $faker->numberBetween(1,3)
            ]);
        }
    }
}
