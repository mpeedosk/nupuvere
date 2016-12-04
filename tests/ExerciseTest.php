<?php

use App\Answer;
use App\Exercise;
use Illuminate\Support\Facades\DB;

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

        $response = $this->call('GET', '/admin/exercise/create/3');

        $this->assertEquals(200, $response->status());

        $response = $this->call('GET', '/admin/exercise/create/4');

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
     * Test that keywords can be added
     *
     * @return void
     */

    public function testExerciseKeywords()
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
            'answer_1' => 'Test answer',
            'keywords' => 'car, fire, cat'
        ];

        $this->call('POST', '/admin/exercise/create/1', $input);
        $this->assertRedirectedTo('/admin/exercise');

        $this->assertCount(1, Exercise::all());
        $this->assertCount(1, Answer::all());

        $ex = Exercise::where('title', 'Test title')->first();

        $this->assertEquals('car, fire, cat', $ex->keywords);
    }

    /**
     * Test that searching by keywords works
     *
     * @return void
     */

    public function testSearchByKeywords()
    {

        $this->testExerciseKeywords();

        $input = [
            'search' => 'car',
        ];

        $this->call('POST', '/search', $input);
        $this->see('Test title');

    }

    /**
     * Test that keywords can be added
     *
     * @return void
     */

    public function testExerciseLicence()
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
            'answer_1' => 'Test answer',
            'keywords' => 'car, fire, cat',
            'licence' => "on"
        ];

        $this->call('POST', '/admin/exercise/create/1', $input);

        $this->assertCount(1, Exercise::all());
        $this->assertCount(1, Answer::all());

        $ex = Exercise::where('title', 'Test title')->first();

        $this->assertEquals(1, $ex->licence);
        $this->visit('/matemaatika/avastaja/raske/'.$ex->id)
            ->see('Litsents:');
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
     * Test that adding multiple choice answers works
     *
     * @return void
     */

    public function testAddMultipleChoice()
    {

        // give this test admin user access
        $this->asAdmin();

        $input = [
            'ex_title' => 'This title',
            'ex_content' => 'Test content',
            'ex_author' => 'Test author',
            'ex_hint' => 'Test hint',
            'ex_solution' => 'Test solution',
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'raske',
            'answer_count' => '3',
            'answer_1' => 'Right answer',
            'incorrect_2' => 'Wrong answer',
            'incorrect_3' => 'Wrong answer'
        ];

        $this->call('POST', '/admin/exercise/create/2', $input);

        $this->assertCount(1, Exercise::all());
        $this->assertCount(3, Answer::all());
    }

    /**
     * Test that adding multiple choice exercises work
     *
     * @return void
     */

    public function testAddMultipleChoiceMany()
    {

        // give this test admin user access
        $this->asAdmin();

        $input = [
            'ex_title' => 'This title',
            'ex_content' => 'Test content',
            'ex_author' => 'Test author',
            'ex_hint' => 'Test hint',
            'ex_solution' => 'Test solution',
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'raske',
            'answer_count' => '4',
            'answer_1' => 'Right answer 1',
            'incorrect_2' => 'Wrong answer 1',
            'incorrect_3' => 'Wrong answer 2',
            'answer_4' => 'Right answer 2'
        ];

        $this->call('POST', '/admin/exercise/create/3', $input);

        $this->assertCount(1, Exercise::all());
        $this->assertCount(4, Answer::all());

        $ans = Answer::where('content', 'Right answer 1')->first();
        $this->assertEquals(1, $ans->is_correct);
        $ans = Answer::where('content', 'Right answer 2')->first();
        $this->assertEquals(1, $ans->is_correct);
        $ans = Answer::where('content', 'Wrong answer 1')->first();
        $this->assertEquals(0, $ans->is_correct);
        $ans = Answer::where('content', 'Wrong answer 2')->first();
        $this->assertEquals(0, $ans->is_correct);

    }


    /**
     * Test that adding ordering exercieses work
     *
     * @return void
     */

    public function testAddOrdering()
    {

        // give this test admin user access
        $this->asAdmin();

        $input = [
            'ex_title' => 'This title',
            'ex_content' => 'Test content',
            'ex_author' => 'Test author',
            'ex_hint' => 'Test hint',
            'ex_solution' => 'Test solution',
            'category' => 'matemaatika',
            'age_group' => 'avastaja',
            'difficulty' => 'raske',
            'answer_count' => '4',
            'answer_1' => 'First',
            'answer_2' => 'Second',
            'answer_3' => 'Third',
            'answer_4' => 'Fourth'
        ];

        $this->call('POST', '/admin/exercise/create/4', $input);

        $this->assertCount(1, Exercise::all());
        $this->assertCount(4, Answer::all());

        $ans = Answer::where('content', 'First')->first();
        $this->assertEquals(1, $ans->order);
        $ans = Answer::where('content', 'Second')->first();
        $this->assertEquals(2, $ans->order);
        $ans = Answer::where('content', 'Third')->first();
        $this->assertEquals(3, $ans->order);
        $ans = Answer::where('content', 'Fourth')->first();
        $this->assertEquals(4, $ans->order);

    }

    /**
     * Adding duplicate titles should not work
     *
     * @return void
     */
    public function testDuplicateExercise(){
        $this->testExerciseAdding();
        $this->visit('/admin/exercise/create/1');
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
        $this->followRedirects();
        $this->see('Selline tunnus on juba kasutusel.');
    }

    /**
     * Hiding exercises should work
     *
     * @return void
     */
    public function testHideExercise(){
        $this->testExerciseAdding();
        $this->visit('/matemaatika/avastaja')
            ->see('Test title');
        $this->visit('/admin/exercise');

        $ex = Exercise::where('title', 'Test title')->first();

        $this->call('POST', '/admin/exercise/hide/'.$ex->id);
        $this->visit('/matemaatika/avastaja')
            ->dontSee('Test title');

    }

    /**
     * Showing hidden exercises should work
     *
     * @return void
     */
    public function testShowExercise(){
        $this->testHideExercise();
        $this->visit('/admin/exercise');

        $ex = Exercise::where('title', 'Test title')->first();

        $this->call('POST', '/admin/exercise/hide/'.$ex->id);
        $this->visit('/matemaatika/avastaja')
            ->see('Test title');

    }
    /**
     * Test that updating multiple choice answers work
     *
     * @return void
     */

    public function testUpdateExercise()
    {

        // give this test admin user access
        $this->testAddMultipleChoice();

        $ex = Exercise::where('title', 'This title')->first();


        $input = [
            'ex_title' => 'This title',
            'ex_content' => 'New Content',
            'ex_author' => 'Test author',
            'ex_hint' => 'Test hint',
            'ex_solution' => 'New solution',
            'category' => 'matemaatika',
            'age_group' => 'uurija',
            'difficulty' => 'raske',
            'answer_count' => '2',
            'answer_1' => 'New answer',
            'incorrect_2' => 'Wrong answer'
        ];

        $this->call('PATCH', '/admin/exercise/edit/'.$ex->id, $input);

        $this->assertCount(1, Exercise::all());
        $this->assertCount(2, Answer::all());

        $ans = Answer::where('content', 'New answer')->first();
        $this->assertEquals(1, $ans->is_correct);
        $ex_updated = Exercise::where('title', 'This title')->first();
        $this->assertEquals($ex->id, $ex_updated->id);
        $this->assertEquals($ex_updated->content, 'New Content');

    }

    /**
     * Test that adding multiple choice answers works
     *
     * @return void
     */

    public function testDeleteExercise()
    {

        $this->testAddMultipleChoiceMany();

        $ex = Exercise::where('title', 'This title')->first();

        $this->call('DELETE', '/admin/exercise/delete/'.$ex->id);

        $this->assertCount(0, Exercise::all());
        $this->assertCount(0, Answer::all());
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

    public function testAdminExerciseView(){
        $this->testExerciseAdding();
        $ex = Exercise::where('title', 'Test title')->first();
        $this->visit('/admin/exercise/edit/'.$ex->id)
            ->see('Test title')
            ->see('Test content')
            ->see('Test author')
            ->see('Test hint')
            ->see('Test solution')
            ->see('value="avastaja" selected')
            ->see('value="raske" selected')
            ->see('Test answer');
    }

    /**
     * Test that adding new categories work
     *
     * @return void
     */

    public function testAddCategory()
    {
        $this->asAdmin();

        $this->visit('/admin/category');
        $input = [
            'name' => 'Algebra',
            'color' => "#5E70D4"
        ];

        $this->call('POST', '/categories/add', $input);
        $this->visit('/')
            ->see('Algebra');

    }

    /**
     *  Adding category with no name should not work
     *
     * @return void
     */

    public function testAddCategoryNoName()
    {
        $this->asAdmin();

        $this->visit('/admin/category');
        $input = [
            'name' => '',
            'color' => "#5E70D4"
        ];

        $this->call('POST', '/categories/add', $input);

        $this->assertEquals(0, DB::table('categories')->count());

        $this->visit('/')
            ->dontSee('Algebra');

    }

    /**
     *  Adding category with no name should not work
     *
     * @return void
     */

    public function testAddCategoryTooLongName()
    {
        $this->asAdmin();

        $this->visit('/admin/category');
        $input = [
            'name' => 'This name has more than 14 letters',
            'color' => "#5E70D4"
        ];

        $this->call('POST', '/categories/add', $input);

        $this->assertEquals(0, DB::table('categories')->count());

        $this->visit('/')
            ->dontSee('Algebra');

    }

    /**
     *  Adding category with the wrong length hex code should not work
     *
     * @return void
     */

    public function testAddCategoryWrongColorFormat()
    {
        $this->asAdmin();

        $this->visit('/admin/category');
        $input = [
            'name' => 'Algebra',
            'color' => "#5E70D44"
        ];

        $this->call('POST', '/categories/add', $input);

        $this->assertEquals(0, DB::table('categories')->count());

        $this->visit('/')
            ->dontSee('Algebra');

    }

    /**
     * Test that editing categories works
     *
     * @return void
     */

    public function testEditCategory()
    {
        $this->asAdmin();

        $this->visit('/admin/category');
        $input = [
            'name' => 'Algebra',
            'color' => "#5E70D6"
        ];

        $this->call('POST', '/categories/add', $input);

        $input = [
            'name' => 'Maths',
            'color' => "#5E70D4"
        ];

        $this->call('POST', '/categories/add', $input);

        $input = [
            'cp-algebra' => '#5E70D6',
            'algebra' => "2",
            'cp-maths' => "#8C499C",
            'maths' => "1"
        ];

        $this->call('PATCH', '/categories/update', $input);

        $algebra = DB::table('categories')->where('name', 'algebra')->first();
        $maths = DB::table('categories')->where('name', 'maths')->first();

        $this->assertEquals(2, $algebra->order);
        $this->assertEquals(1, $maths->order);

    }

    /**
     *  Test deleting categories
     *
     * @return void
     */

    public function testDeleteCategory()
    {
        $this->testAddCategory();

        $cat_id = DB::table('categories')->where('name', 'algebra')->pluck('id')->first();

        $this->call('DELETE', '/categories/delete/'.$cat_id);

        $this->assertEquals(0, DB::table('categories')->count());

        $this->visit('/')
            ->dontSee('Algebra');

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
