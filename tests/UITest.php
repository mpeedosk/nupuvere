<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UITest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFrontPage()
    {
        $this->visit('/')
             ->see('Telephone')
             ->see('Email')
             ->see('Otsi');
    }

    public function testMenu()
    {
        $this->visit('/')
             ->click('Avastajad')
             ->see('Keskmine')
             ->see('Lihtne')
             ->see('Raske')
             ->dontSee('Telephone');
    }
    public function testExerciseEasy()
    {
        $this->visit('/matemaatika/avastaja')
            ->click('Ülesanne 1')
            ->see('Nimekiri')
            ->see('Edasi')
            ->see('Vihje')
            ->see('Koostanud')
            ->see('Sisestage vastus')
            ->dontSee('Telephone');
}
    public function testExerciseMedium()
    {
        $this->visit('/matemaatika/avastaja')
            ->click('Mitu õiget varianti')
            ->see('Nimekiri')
            ->see('Edasi')
            ->see('Vihje')
            ->see('Koostanud')
            ->dontSee('Telephone');
    }

    public function testMenu2()
    {
        $this->visit('/')
             ->type('martinliba','username')
             ->type('parool','password')
             ->press('Logi sisse')
             ->visit('/matemaatika/avastaja')
             ->click('Ülesanne 1')
             ->type('225g','answer-input')
             ->press('Vasta');
            
             
    }

}
