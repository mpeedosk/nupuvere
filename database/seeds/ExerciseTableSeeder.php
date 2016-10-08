<?php

use Illuminate\Database\Seeder;

class ExerciseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exercises')->insert([[
            'title' => 'Ülesanne 1',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => 'Retseptis oli öeldud, et antud kogustega tuleb hea ja õige paksusega kook, kui kasutada küpsetusplaati mõõtmetega 20cm x 28cm. Kertu tahtis teha sama paksu kooki, aga tema küpsetusplaat oli mõõtmetega 24cm x 35cm. Mitu grammi peab Kertu taignasse võid panema, kui retseptis on öeldud, et võid tuleb panna 150 grammi?',
            'hint' => 'https://www.wikiwand.com/et/Matemaatika 2. \n klassi õpik, lehekülg 62',
            'type' => 1,
            'answer' => '225g',
            'category_id' => DB::table('categories')->where('name','matemaatika')->pluck('id')->first(),
            'age_group' => 1,
            'difficulty' => 1,
            'solved' => 0,
            'attempted' => 120
        ],[
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'title' => 'Ülesanne 4',
            'content' => 'Aadu, Beedu, Ceedu ja Deedu koolikottides on kokku 16 õpikut. Seejuurers igas kotis on vähemalt üks õpik. Ceedu ja Deedu kottides on kokku 9 õpikut. Aadu kotis olevate õpikute arv on suurem kui üheski teises kotis olevate õpikute arv. Mitu õpikut on Beedu kotis?',
            'hint' => 'Aadul ja Beedul on kokku 7 õpikut',
            'type' => 1,
            'answer' => 'Aadul on kotis 6 õpikut.',
            'category_id' => DB::table('categories')->where('name','matemaatika')->pluck('id')->first(),
            'age_group' => 1,
            'difficulty' => 1,
            'solved' => 0,
            'attempted' => 120
        ],[
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'title' => 'Ülesanne 2',
            'content' => 'Aadu, Beedu, Ceedu ja Deedu koolikottides on kokku 16 õpikut. Seejuurers igas kotis on vähemalt üks õpik. Ceedu ja Deedu kottides on kokku 9 õpikut. Aadu kotis olevate õpikute arv on suurem kui üheski teises kotis olevate õpikute arv. Mitu õpikut on Beedu kotis?',
            'hint' => 'Aadul ja Beedul on kokku 7 õpikut',
            'type' => 1,
            'answer' => 'Aadul on kotis 6 õpikut.',
            'category_id' => DB::table('categories')->where('name','matemaatika')->pluck('id')->first(),
            'age_group' => 1,
            'difficulty' => 2,
            'solved' => 0,
            'attempted' => 120
        ],[
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'title' => 'Ülesanne 3',
            'content' => 'Kahekohaline arv on 10 võrra suurem kui selle arvu kolmekordne numbrite summa. Arvu üheliste number on ühe võrra suurem kui kümneliste number korrutatud kahega. Leia see kahekohaline arv.',
            'hint' => 'Kahekohalise arvu saab esitada kui 10x+y',
            'type' => 1,
            'answer' => 'See kahekohaline arv on 49.',
            'category_id' => DB::table('categories')->where('name','matemaatika')->pluck('id')->first(),
            'age_group' => 1,
            'difficulty' => 3,
            'solved' => 0,
            'attempted' => 120
        ]]);
    }
}
