<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'username' => 'mpeedosk',
            'first_name' => 'Martin',
            'last_name' => 'Peedosk',
            'email' => 'martinpeedosk@gmail.com',
            'password' => bcrypt('parool'),
            'role' => 1,
            'points' => 228
        ],[
            'username' => 'valsalo',
            'first_name' => 'Alo',
            'last_name' => 'Vals',
            'email' => 'alo.vals@outlook.com',
            'password' => bcrypt('parool'),
            'role' => 1,
            'points' => 199
        ],[
            'username' => 'martinliba',
            'first_name' => 'Martin',
            'last_name' => 'Liba',
            'email' => 'martinjohl@gmail.com',
            'password' => bcrypt('parool'),
            'role' => 1,
            'points' => 129
        ],[
            'username' => 'nlaura',
            'first_name' => 'Helbe-Laura',
            'last_name' => 'Nikitkina',
            'email' => 'nlaura@gmail.com',
            'password' => bcrypt('parool'),
            'role' => 1,
            'points' => 543
        ],[
            'username' => 'user',
            'first_name' => 'firstName',
            'last_name' => 'lastName',
            'email' => 'regular@example.com',
            'password' => bcrypt('parool'),
            'role' => 1,
            'points' => 125
        ],[
            'username' => 'admin',
            'first_name' => 'firstName',
            'last_name' => 'lastName',
            'email' => 'admin@example.com',
            'password' => bcrypt('parool'),
            'role' => 2,
            'points' => 0
        ],[
            'username' => 'superAdmin',
            'first_name' => 'firstName',
            'last_name' => 'lastName',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('parool'),
            'role' => 3,
            'points' => 0
        ],[
            'username' => 'test',
            'first_name' => 'testfirstName',
            'last_name' => 'testlastName',
            'email' => 'test@example.com',
            'password' => bcrypt('test'),
            'role' => 1,
            'points' => 76
        ]]);


        $faker = Faker\Factory::create();

        // Generate some dummy data
        for($i=0; $i<250; $i++) {
            User::create([
                'username' => $faker->unique()->userName(),
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => $faker->unique()->email(),
                'password' => bcrypt("parool"),
                'role' => $faker->numberBetween(1,3),
                'points' => $faker->numberBetween(0, 200),
                'points_this_year' => $faker->numberBetween(0, 100)
            ]);
        }
    }
}
