<?php

use App\Answer;
use App\Exercise;

class ExerciseTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->artisan('migrate');
    }

    public function tearDown()
    {
        $this->artisan('migrate:reset');
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDatabase()
    {
        $exercise = new Exercise;

        $exercise->type = Exercise::TEXTUAL;

        $exercise->title = "Test title";
        $exercise->content = "Test content";
        $exercise->author = "Test author";
        $exercise->hint = "Test hint";
        $exercise->solution = "Test solution";

        $exercise->category = "matemaatika";
        $exercise->age_group = "avastaja";
        $exercise->difficulty = "keskmine";

        $exercise->save();

        $answer = new Answer;
        $answer->content = "Test answer";
        $answer->is_correct = true;
        $answer->order = 1;
        $answer->ex_id = $exercise->id;
        $answer->save();

        $this->assertCount(1, Exercise::all());
        $this->assertCount(1, Answer::all());

        $response = $this->call('GET', '/matemaatika/avastaja/keskmine/'.$exercise->id);

        $this->assertEquals(200, $response->status());
    }

    public function testUserRoutes(){
        $response = $this->call('GET', '/');

        $this->assertEquals(200, $response->status());

        $response = $this->call('GET', '/matemaatika/avastaja');

        $this->assertEquals(200, $response->status());

        $response = $this->call('POST', '/exercise/check/1');

        $this->assertEquals(302, $response->status());
    }

    public function testAdminRoutes(){

        $this->asAdmin();

        $this->call('GET', '/admin');

        $this->assertRedirectedTo('/admin/home');

        $response = $this->call('GET', '/admin/home');

        $this->assertEquals(200, $response->status());

        $response = $this->call('GET', '/admin/category');

        $this->assertEquals(200, $response->status());

        $response = $this->call('GET', '/admin/exercise');

        $this->assertEquals(200, $response->status());

        $response = $this->call('GET', '/exercise/text');

        $this->assertEquals(200, $response->status());
    }

    public function testExerciseAdding(){

        $this->asAdmin();

        $input = [
            'ex_title' => 'Test title',
            'ex_content' => 'Test content',
            'ex_author' => 'Test author',
            'ex_hint' => 'Test hint',
            'ex_solution' => 'Test solution',
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'raske',
            'answer_count' => '1',
            'answer_1' => 'Test answer'
        ];

        $this->call('POST', 'exercise/text/create', $input);
        $this->assertRedirectedTo('/admin/exercise');


        $this->assertCount(1, Exercise::all());
        $this->assertCount(1, Answer::all());
    }


    public function testExerciseAddingEmpty(){

        $this->asAdmin();

        $input = [
            'ex_title' => '',
            'ex_content' => '',
            'ex_author' => '',
            'ex_hint' => '',
            'ex_solution' => '',
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'raske',
            'answer_count' => '1',
            'answer_1' => 'Test answer'
        ];

        $this->call('POST', 'exercise/text/create', $input);

        $this->assertCount(0, Exercise::all());
        $this->assertCount(0, Answer::all());
    }
    public function testExerciseAddingNoOptionals(){

        $this->asAdmin();

        $input = [
            'ex_title' => 'Test Title',
            'ex_content' => 'Test content',
            'ex_author' => '',
            'ex_hint' => '',
            'ex_solution' => '',
            'category' => 'füüsika',
            'age_group' => 'uurija',
            'difficulty' => 'keskmine',
            'answer_count' => '1',
            'answer_1' => 'Test answer'
        ];

        $this->call('POST', 'exercise/text/create', $input);

        $this->assertCount(1, Exercise::all());
        $this->assertCount(1, Answer::all());
    }

    public function testExerciseAddingMultipleAnswers(){

        $this->asAdmin();

        $input = [
            'ex_title' => 'Test Title',
            'ex_content' => 'Test content',
            'ex_author' => '',
            'ex_hint' => '',
            'ex_solution' => '',
            'category' => 'füüsika',
            'age_group' => 'uurija',
            'difficulty' => 'keskmine',
            'answer_count' => '3',
            'answer_1' => 'Test answer 1',
            'answer_2' => 'Test answer 2',
            'answer_3' => 'Test answer 3'
        ];

        $this->call('POST', 'exercise/text/create', $input);

        $this->assertCount(1, Exercise::all());
        $this->assertCount(3, Answer::all());
    }


    public function testExerciseAddingTooLongTitle(){

        $this->asAdmin();

        $input = [
            'ex_title' => 'This title is too long (>20)',
            'ex_content' => 'Test content',
            'ex_author' => 'Test author',
            'ex_hint' => 'Test hint',
            'ex_solution' => 'Test solution',
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'raske',
            'answer_count' => '1',
            'answer_1' => 'Test answer'
        ];

        $this->call('POST', 'exercise/text/create', $input);

        $this->assertCount(0, Exercise::all());
        $this->assertCount(0, Answer::all());
    }

    public function testExerciseAnswer(){

        $this->testExerciseAddingMultipleAnswers();
        $this->asUser();

        $input = [
            'answer-input' => 'Test answer 1'
        ];

        $this->call('POST', '/exercise/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');
    }


    public function testExerciseAnswers(){

        $this->testExerciseAddingMultipleAnswers();
        $this->asUser();

        $input = [
            'answer-input' => 'Test answer 2'
        ];

        $this->call('POST', '/exercise/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');

        $input = [
            'answer-input' => 'Test answer 3'
        ];

        $this->call('POST', '/exercise/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');
    }


    public function testExerciseAnswerIgnoreCase(){

        $this->testExerciseAddingMultipleAnswers();
        $this->asUser();

        $input = [
            'answer-input' => 'test answer 1'
        ];

        $this->call('POST', '/exercise/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');

        $input = [
            'answer-input' => 'TEST ANSWER 1'
        ];

        $this->call('POST', '/exercise/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');
    }


    public function testExerciseAnswerIgnoreSpaces(){

        $this->testExerciseAddingMultipleAnswers();
        $this->asUser();

        $input = [
            'answer-input' => '     test       answer    1    '
        ];

        $this->call('POST', '/exercise/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');

        $input = [
            'answer-input' => 'TESTANSWER1'
        ];

        $this->call('POST', '/exercise/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');
    }

    public function testExerciseAnswerWrong(){

        $this->testExerciseAddingMultipleAnswers();
        $this->asUser();

        $input = [
            'answer-input' => 'Test answer 5'
        ];

        $this->call('POST', '/exercise/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite valesti!');
    }

    public function testExerciseAnswerSolution(){

        $this->testExerciseAdding();
        $this->asUser();

        $input = [
            'answer-input' => 'Test answer'
        ];

        $this->call('POST', '/exercise/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');
        $this->see('Test solution');
    }

    public function asAdmin(){
        $user = factory(App\User::class)->create();
        $user->role = App\User::ADMIN;
        $user->save();
        $this->actingAs($user);
    }
    public function asUser(){
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
    }
}
