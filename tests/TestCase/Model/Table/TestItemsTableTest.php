<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TestItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TestItemsTable Test Case
 */
class TestItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TestItemsTable
     */
    public $TestItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.test_items',
        'app.test_plans',
        'app.users',
        'app.test_questions',
        'app.test_runs',
        'app.streams',
        'app.data_streams',
        'app.instruments',
        'app.nodes',
        'app.sites',
        'app.regions',
        'app.notes',
        'app.deployments',
        'app.calibrations',
        'app.monthly_stats',
        'app.parameters',
        'app.parameter_functions',
        'app.parameters_streams'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TestItems') ? [] : ['className' => 'App\Model\Table\TestItemsTable'];
        $this->TestItems = TableRegistry::get('TestItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TestItems);

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
