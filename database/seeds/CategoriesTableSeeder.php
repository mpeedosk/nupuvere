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
            'order' => 1,
            'color' => "#D14A94"
        ],[
            'name' => 'füüsika',
            'order' => 2,
            'color' => "#8C499C"
        ],[
            'name' => 'keemia',
            'order' => 3,
            'color' => "#5EA0D6"
        ],[
            'name' => 'bioloogia',
            'order' => 4,
            'color' => "#62BD63"
        ],[
            'name' => 'geograafia',
            'order' => 5,
            'color' => "#f1EA32"
        ],[
            'name' => 'ajalugu',
            'order' => 6,
            'color' => "#EEAC1f"
        ]]);
    }
}
