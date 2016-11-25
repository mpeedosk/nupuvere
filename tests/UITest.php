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

    //"see" kontrollib, kas kirjeldatud teksti on näha
     //"dontSee" kontrollib, kas kirjeldatud teksti ei ole näha
     //"click" vajutab kirjeldatud lingile
     //"visit" läheb kirjeldatud lehele
     //"type" kirjutab teises argumendis kirjeldatud lahtrisse esimese argumendi teksti
     //"press" vajutab kirjeldatud nupule

    public function setUp()
    {
        parent::setUp();

        $this->artisan('migrate');
        Artisan::call('db:seed', ['--database' => 'testing']);
    }

    public function tearDown()
    {
        $this->artisan('migrate:reset');
    }


    //core use-case-de kasutajaliidese testid.
    public function testFrontPage() //esilehe test
    {
        $this->visit('/')
             ->seePageIs('/');
    }

    public function testMenu()//esilehe menüü test
    {
        $this->visit('/')
             ->click('Avastajad')
             ->see('Keskmine')
             ->see('Lihtne')
             ->see('Raske')
             ->dontSee('Telephone');
    }
    public function testSeeExerciseEasy()//kontrollib kas menüü valimine kuvatakse.
    {
        $this->visit('/matemaatika/avastaja')
            ->click('Ülesanne 1')
            ->see('Nimekiri')
            ->see('Edasi')
            ->see('Vihje')
            ->see('Sisestage vastus')
            ->dontSee('Telephone');
}
    public function testSeeExerciseMedium()//kontrollib kas menüü valimine kuvatakse.
    {
        $this->visit('/matemaatika/avastaja')
            ->click('Mitu õiget varianti')
            ->see('Nimekiri')
            ->see('Edasi')
            ->see('Vihje')
            ->dontSee('Telephone');
    }

    public function testSolvExerciseAvastajadEasy()//Kontrollib kas ülesande lahendamine kuvatakse õigesti.
    {
        $this->visit('/')
             ->type('martinliba','login')
             ->type('parool','password')
             ->press('Logi sisse')
             ->visit('/matemaatika/avastaja')
             ->click('Ülesanne 1')
             ->type('225g','answer-input')
             ->press('Vasta')
             ->see('Retseptis');
    }


   public function testAdminAddExercise() // Kontrolliba, kui admin lisab ülesandeid, kas kõik kuvatakse õigesti.
    {
        $this->visit('/')
             ->type('admin','login')
             ->type('parool','password')
             ->press('Logi sisse')
             ->see('Admin')
             ->click('Admin')
             ->see('Kategooriad')
             ->click('Ülesanded')
             ->see('Lisa uus')
             ->click('Tekstiline/numbriline')
             ->see('Lisa vastus')
             ->type('testülesanne','ex_title')
             ->type('testautor','ex_author')
             ->type('test ülesande sisu','ex_content')
             ->type('test','answer')
             ->type('matemaatika','category')
             ->press('Lisa ülesanne')
             ->click('Ülesanded')
             ->see('testülesanne');
        }

    public function testAdminAddExerciseEmptyTitle()//Kontrollib, kas veateade kuvatakse õigesti, kui ülesande lisamisel pealikiri jääb tühjaks.
    {
        $this->visit('/')
             ->type('admin','login')
             ->type('parool','password')
             ->press('Logi sisse')
             ->see('Admin')
             ->click('Admin')
             ->see('Kategooriad')
             ->click('Ülesanded')
             ->see('Lisa uus')
             ->click('Tekstiline/numbriline')
             ->see('Lisa vastus')
             ->type('','ex_title')
             ->type('testautor','ex_author')
             ->type('test ülesande sisu','ex_content')
             ->type('test','answer')
             ->type('matemaatika','category')
             ->press('Lisa ülesanne')
             ->see('The ex title field is required.');
        }

    public function testAdminAddExerciseEmptyContent()//Kontrollib, kas veateade kuvatakse õigesti, kui ülesande lisamisel sisu jääb tühjaks.
    {
        $this->visit('/')
             ->type('admin','login')
             ->type('parool','password')
             ->press('Logi sisse')
             ->see('Admin')
             ->click('Admin')
             ->see('Kategooriad')
             ->click('Ülesanded')
             ->see('Lisa uus')
             ->click('Tekstiline/numbriline')
             ->see('Lisa vastus')
             ->type('','ex_title')
             ->type('testautor','ex_author')
             ->type('','ex_content')
             ->type('test','answer')
             ->type('matemaatika','category')
             ->press('Lisa ülesanne')
             ->see('The ex content field is required.');
        }
}