<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TestQuestionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TestQuestionsTable Test Case
 */
class TestQuestionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TestQuestionsTable
     */
    public $TestQuestions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.test_questions',
        'app.test_runs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TestQuestions') ? [] : ['className' => 'App\Model\Table\TestQuestionsTable'];
        $this->TestQuestions = TableRegistry::get('TestQuestions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TestQuestions);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
