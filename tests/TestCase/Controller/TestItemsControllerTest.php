<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TestItemsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\TestItemsController Test Case
 */
class TestItemsControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
