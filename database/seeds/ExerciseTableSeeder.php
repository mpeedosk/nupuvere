<?php

use Illuminate\Database\Seeder;

class ExerciseTableSeeder extends Seeder
{

    const age_groups = array("avastaja", "uurija", "teadja", "ekspert");
    const difficulties = array("lihtne", "keskmine", "raske");

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
            'solution' => 'Retseptis antud küpsetusplaadi pindala on 20·28=560 cm2. Kertu küpsetusplaadi pindala oli 24·35=840 cm2. Seega plaadi pindala oli 840:560=1,5 korda suurem. Sama paksu koogi tegemiseks tuli järelikult ka tainast teha 1,5 korda rohkem. Et retsepti kohaselt oli vaja panna 150 grammi võid, siis Kertul tuli võid panna 1,5·150 = 225 grammi',
            'type' => 1,
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
            'solution' => 'Lahenduskäik 4',
            'type' => 1,
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
            'solution' => null,
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
            'solution' => null,
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'raske',
            'solved' => 0,
            'attempted' => 120
        ],[
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'title' => 'Üks õige vastus',
            'content' => 'Milline neist on karu?',
            'hint' => 'no hint for you',
            'solution' => null,
            'type' => 2,
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'raske',
            'solved' => 0,
            'attempted' => 0
        ],[
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'title' => 'Mitu õiget varianti',
            'content' => 'Millised neist loomadest on imetajad?',
            'hint' => 'no hint for you',
            'solution' => null,
            'type' => 3,
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'keskmine',
            'solved' => 0,
            'attempted' => 0
        ],[
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'title' => 'Järjestamine',
            'content' => 'Järjesta järgmised sõidukid alustades kõige väiksemast',
            'hint' => 'no hint for you',
            'solution' => null,
            'type' => 4,
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'keskmine',
            'solved' => 0,
            'attempted' => 0
        ]]);
        // Generate some dummy data

        $faker = Faker\Factory::create();

        foreach (\App\Category::getCategories() as $category){
            foreach (self::age_groups as $age_group){
                foreach (self::difficulties as $difficulty){
                    for($i=0; $i < $faker->numberBetween(6,25); $i++) {
                        \App\Exercise::create([
                            'title' => $faker->unique()->sentence(3),
                            'content' => $faker->text($maxNbChars = 1000),
                            'hint' =>  $faker->text($maxNbChars = 200),
                            'solution' => $faker->text($maxNbChars = 500),
                            'type' => $faker->numberBetween(1,4),
                            'category' => $category->name,
                            'age_group' => $age_group,
                            'difficulty' => $difficulty,
                            'solved' => $faker->numberBetween(10,200),
                            'attempted' => $faker->numberBetween(200,2000),
                        ]);
                    }
                }
            }
        }

    }
}
