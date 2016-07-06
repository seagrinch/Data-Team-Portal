<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TestPlansTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TestPlansTable Test Case
 */
class TestPlansTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TestPlansTable
     */
    public $TestPlans;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.test_plans',
        'app.users',
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
        $config = TableRegistry::exists('TestPlans') ? [] : ['className' => 'App\Model\Table\TestPlansTable'];
        $this->TestPlans = TableRegistry::get('TestPlans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TestPlans);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
