<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([[
            'name' => 'matemaatika',
            'order' => 1
        ],[
            'name' => 'füüsika',
            'order' => 2
        ],[
            'name' => 'keemia',
            'order' => 3
        ],[
            'name' => 'bioloogia',
            'order' => 4
        ],[
            'name' => 'geograafia',
            'order' => 5
        ],[
            'name' => 'ajalugu',
            'order' => 6
        ]]);
    }
}
