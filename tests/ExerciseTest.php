<?php

use App\Answer;
use App\Exercise;

class ExerciseTest extends TestCase
{
    /**
     * Setting up tests
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->artisan('migrate');
    }

    /**
     * Reseting initial setup
     *
     * @return void
     */
    public function tearDown()
    {
        $this->artisan('migrate:reset');
    }


    /**
     * Checking if connection works with DB
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

        $response = $this->call('GET', '/matemaatika/avastaja/keskmine/' . $exercise->id);

        $this->assertEquals(200, $response->status());
    }

    /**
     * Test that route are working for normal users
     *
     * Displaying main page, exercise list and
     * exercise post redirect routes are working
     *
     * @return void
     */
    public function testUserRoutes()
    {
        $response = $this->call('GET', '/');

        $this->assertEquals(200, $response->status());

        $response = $this->call('GET', '/matemaatika/avastaja');

        $this->assertEquals(200, $response->status());

        $response = $this->call('POST', '/answer/check/1');

        $this->assertEquals(302, $response->status());
    }

    /**
     * Test that route are working for administrator
     *
     * Displaying main page, exercise list and
     * exercise post redirect routes are working
     *
     * @return void
     */
    public function testAdminRoutes()
    {

        $this->asAdmin();

        $this->call('GET', '/admin');

        $this->assertRedirectedTo('/admin/home');

        $response = $this->call('GET', '/admin/home');

        $this->assertEquals(200, $response->status());

        $response = $this->call('GET', '/admin/category');

        $this->assertEquals(200, $response->status());

        $response = $this->call('GET', '/admin/exercise');

        $this->assertEquals(200, $response->status());

        $response = $this->call('GET', '/admin/exercise/create/1');

        $this->assertEquals(200, $response->status());

        $response = $this->call('GET', '/admin/exercise/create/2');

        $this->assertEquals(200, $response->status());
    }

    /**
     * Test that valid exercise can be added to DB
     *
     * @return void
     */

    public function testExerciseAdding()
    {

        // give this test admin user access
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

        $this->call('POST', '/admin/exercise/create/1', $input);
        $this->assertRedirectedTo('/admin/exercise');


        $this->assertCount(1, Exercise::all());
        $this->assertCount(1, Answer::all());
    }

    /**
     * Test that exercise has empty mandatory fields
     *
     * @return void
     */

    public function testExerciseAddingEmpty()
    {

        // give this test admin user access
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

        $this->call('POST', '/admin/exercise/create/1', $input);

        $this->assertCount(0, Exercise::all());
        $this->assertCount(0, Answer::all());
    }

    /**
     * Test that exercise has one correct answer
     *
     * @return void
     */

    public function testExerciseAddingNoOptionals()
    {

        // give this test admin user access
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

        $this->call('POST', '/admin/exercise/create/1', $input);

        $this->assertCount(1, Exercise::all());
        $this->assertCount(1, Answer::all());
    }

    /**
     * Test that multiple answers can be added
     *
     * @return void
     */

    public function testExerciseAddingMultipleAnswers()
    {

        // give this test admin user access
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

        $this->call('POST', '/admin/exercise/create/1', $input);

        $this->assertCount(1, Exercise::all());
        $this->assertCount(3, Answer::all());
    }

    /**
     * Test that exercise heading does not fit to limit
     *
     * @return void
     */

    public function testExerciseAddingTooLongTitle()
    {

        // give this test admin user access
        $this->asAdmin();

        $input = [
            'ex_title' => 'This title is too long This title is too long This title is too long(>37)',
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

        $this->call('POST', '/admin/exercise/create/1', $input);

        $this->assertCount(0, Exercise::all());
        $this->assertCount(0, Answer::all());
    }

    /**
     * Test that the exercise accepts multiple answers
     *
     * @return void
     */

    public function testExerciseAnswer()
    {

        // populate the DB with an exercise
        $this->testExerciseAddingMultipleAnswers();
        // give this test regular user access
        $this->asUser();

        $input = [
            'answer-input' => 'Test answer 1'
        ];

        $this->call('POST', '/answer/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');
    }

    /**
     * Test that system accepts correct answer
     *
     * @return void
     */

    public function testExerciseAnswers()
    {

        // populate the DB with an exercise
        $this->testExerciseAddingMultipleAnswers();

        // give this test regular user access
        $this->asUser();

        $input = [
            'answer-input' => 'Test answer 2'
        ];

        $this->call('POST', '/answer/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');

        $input = [
            'answer-input' => 'Test answer 3'
        ];

        $this->call('POST', '/answer/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');
    }

    /**
     * Test that system ignores answer case
     *
     * @return void
     */

    public function testExerciseAnswerIgnoreCase()
    {

        // populate the DB with an exercise
        $this->testExerciseAddingMultipleAnswers();

        // give this test regular user access
        $this->asUser();

        $input = [
            'answer-input' => 'test answer 1'
        ];

        $this->call('POST', '/answer/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');

        $input = [
            'answer-input' => 'TEST ANSWER 1'
        ];

        $this->call('POST', '/answer/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');
    }

    /**
     * Test that system ignores answer spaces
     *
     * @return void
     */

    public function testExerciseAnswerIgnoreSpaces()
    {

        // populate the DB with an exercise
        $this->testExerciseAddingMultipleAnswers();

        // give this test regular user access
        $this->asUser();

        $input = [
            'answer-input' => '     test       answer    1    '
        ];

        $this->call('POST', '/answer/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');

        $input = [
            'answer-input' => 'TESTANSWER1'
        ];

        $this->call('POST', '/answer/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');
    }

    /**
     * Test that exercise solution and aswer
     *
     * @return void
     */

    public function testExerciseAnswerWrong()
    {

        // populate the DB with an exercise
        $this->testExerciseAddingMultipleAnswers();

        // give this test regular user access
        $this->asUser();

        $input = [
            'answer-input' => 'Test answer 5'
        ];

        $this->call('POST', '/answer/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite valesti!');
    }

    /**
     * Test that exercise solution and aswer
     *
     * @return void
     */

    public function testExerciseAnswerSolution()
    {

        // populate the DB with an exercise
        $this->testExerciseAdding();

        // give this test regular user access
        $this->asUser();

        $input = [
            'answer-input' => 'Test answer'
        ];

        $this->call('POST', '/answer/check/1', $input);
        $this->followRedirects();
        $this->see('Vastasite õigesti!');
        $this->see('Test solution');
    }

    /**
     * Log in as administrator
     *
     * @return void
     */

    public function asAdmin()
    {
        $user = factory(App\User::class)->create();
        $user->role = App\User::ADMIN;
        $user->save();
        $this->actingAs($user);
    }

    /**
     * Log in as regular user
     *
     * @return void
     */

    public function asUser()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
    }
}
