<?php

use Illuminate\Database\Seeder;

class FrontPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('page')->insert([
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'content' => '<p>
                    <span>Telephone:</span> 1-800-123-4567
                    <br>
                    <span>Email:</span>
                    <a href="mailto:info@example.com">info@example.com</a>
                    <br>
                    <span>Website:</span>
                    <a href="http://www.example.com">www.example.com</a>
                </p>'
        ]);
    }
}
