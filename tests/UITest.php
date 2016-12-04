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


    public function testShowExerciseAvastajadEasy()//Kontrollib kas ülesande valimine ja kuvamine toimib õigesti(sisselogitud).
    {
        $this->visit('/')
             ->type('martinliba','login')
             ->type('parool','password')
             ->press('Logi sisse')
             ->visit('/matemaatika/avastaja')
             ->click('Ülesanne 1')
             ->see('Ülesanne 1')
             ->see('Retseptis oli öeldud, et antud kogustega tuleb hea ja õige paksusega kook, kui kasutada')
             ->see('Vihje');
    }
    
    public function testShowExerciseAvastajadEasyNotLoggedIn()//Kontrollib kas ülesande valimine ja kuvamine toimib õigesti(sisselogimata).
    {
        $this->visit('/')
             ->visit('/matemaatika/avastaja')
             ->click('Ülesanne 1')
             ->see('Ülesanne 1')
             ->see('Retseptis oli öeldud, et antud kogustega tuleb hea ja õige paksusega kook, kui kasutada')
             ->see('Vihje');
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

    public function testSkipExerciseAvastajadEasy()//Kontrollib kas ülesande vahelejätmine kuvatakse õigesti(sisselogitud).
    {
        $this->visit('/')
             ->type('martinliba','login')
             ->type('parool','password')
             ->press('Logi sisse')
             ->visit('/matemaatika/avastaja')
             ->click('Ülesanne 1')
             ->click('Edasi')
             ->see('Ülesanne 4')
             ->see('Aadu, Beedu, Ceedu ja')
             ->see('vasta');
    }
    public function testSkipExerciseAvastajadEasyNotLoggedIn()//Kontrollib kas ülesande vahelejätmine kuvatakse õigesti(sisselogimata).
    {
        $this->visit('/')
             ->visit('/matemaatika/avastaja')
             ->click('Ülesanne 1')
             ->click('Edasi')
             ->see('Ülesanne 4')
             ->see('Aadu, Beedu, Ceedu ja');
    }

 public function testSkipExerciseAvastajadEasyLastEX()//Kontrollib, kas ülesande vahelejätmine kuvatakse õigesti, kui tegemist on viimase ülesandega nimekirjas(sisselogitud).
    {
        $this->visit('/')
             ->type('martinliba','login')
             ->type('parool','password')
             ->press('Logi sisse')
             ->visit('/matemaatika/avastaja')
             ->click('Ülesanne 1')
             ->click('Edasi')
             ->see('Ülesanne 4')
             ->see('Aadu, Beedu, Ceedu ja')
             ->see('vasta')
             ->click('Edasi')
             ->see('Lihtne')
             ->see('Raske');
    }

    public function testSkipExerciseAvastajadEasyLastEXNotLoggedIn()//Kontrollib, kas ülesande vahelejätmine kuvatakse õigesti, kui tegemist on viimase ülesandega nimekirjas(sisselogimata).
    {
        $this->visit('/')
             ->visit('/matemaatika/avastaja')
             ->click('Ülesanne 1')
             ->click('Edasi')
             ->see('Ülesanne 4')
             ->see('Aadu, Beedu, Ceedu ja')
             ->see('vasta')
             ->click('Edasi')
             ->see('Lihtne')
             ->see('Raske');
    }

   public function testAdminAddExercise() // Kontrollib, kui admin lisab ülesandeid, kas kõik kuvatakse õigesti.
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
             ->visit('/matemaatika/avastaja')
             ->see('testülesanne');
        }

        public function testAdminUpdateExercise() // Kontrollib, kui admin uuendab ülesandeid, kas kõik kuvatakse õigesti.
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
             ->visit('/admin/exercise/edit/1')
             ->see('Uuenda')
             ->type('Uuendatud autor','ex_author')
             ->type('Uuendatud ülesande sisu','ex_content')
             ->press('Uuenda')
             ->visit('/matemaatika/avastaja')
             ->click('Ülesanne 1')
             ->see('Uuendatud autor')
             ->see('Uuendatud ülesande sisu');
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
             ->see('See tunnus on kohustuslik.');
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
             ->see('See tunnus on kohustuslik.');
        }

        public function testAdminChangeCategory() // Kontrollib, kui admin lisab kategooria, kas kõik kuvatakse õigesti.
    {
        $this->visit('/')
             ->type('admin','login')
             ->type('parool','password')
             ->press('Logi sisse')
             ->see('Admin')
             ->click('Admin')
             ->see('Kategooriad')
             ->click('Kategooriad')
             ->see('Uus kategooria:')
             ->type('Testk','name')
             ->press('Lisa uus')
             ->see('Testk');
        }


        public function testAdminChangeCategoryOrder() // Kontrollib, kui admin muudab kategooria järjekorda, kas kõik kuvatakse õigesti.
    {
        $this->visit('/')
             ->type('admin','login')
             ->type('parool','password')
             ->press('Logi sisse')
             ->see('Admin')
             ->click('Admin')
             ->see('Kategooriad')
             ->click('Kategooriad')
             ->see('Uus kategooria:')
             ->type('Testk','name')
             ->press('Lisa uus')
             ->see('Testk')
              ->type('1','testk')
             ->type('7','matemaatika')
             ->press('Salvesta')
             ->click('Tagasi pealehele')
             ->see('Testk');
        }

        public function testAdminBeholdExercises() // Kontrollib, kas admin näeb ülesandeid.
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
             ->see('Ülesanded');
        }

}