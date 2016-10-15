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
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'lihtne',
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
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'lihtne',
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
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'keskmine',
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
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'raske',
            'solved' => 0,
            'attempted' => 120
        ],[
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'title' => 'Ülesanne 5',
            'content' => 'Üks õige variant',
            'hint' => 'no hint for you',
            'type' => 2,
            'answer' => 'one',
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'raske',
            'solved' => 0,
            'attempted' => 0
        ],[
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'title' => 'Mitu õiget varianti',
            'content' => 'Multiple choice with many correct',
            'hint' => 'no hint for you',
            'type' => 3,
            'answer' => 'one',
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'keskmine',
            'solved' => 0,
            'attempted' => 0
        ],[
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'title' => 'Ülesanne 7',
            'content' => 'Järjestamine',
            'hint' => 'no hint for you',
            'type' => 4,
            'answer' => 'one',
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'keskmine',
            'solved' => 0,
            'attempted' => 0
        ]]);
    }
}
