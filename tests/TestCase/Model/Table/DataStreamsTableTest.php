<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DataStreamsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DataStreamsTable Test Case
 */
class DataStreamsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DataStreamsTable
     */
    public $DataStreams;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.data_streams',
        'app.instruments',
        'app.nodes',
        'app.sites',
        'app.regions',
        'app.deployments',
        'app.calibrations',
        'app.streams',
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
        $config = TableRegistry::exists('DataStreams') ? [] : ['className' => 'App\Model\Table\DataStreamsTable'];
        $this->DataStreams = TableRegistry::get('DataStreams', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DataStreams);

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
