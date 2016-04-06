<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParameterFunctionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ParameterFunctionsTable Test Case
 */
class ParameterFunctionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ParameterFunctionsTable
     */
    public $ParameterFunctions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.parameter_functions',
        'app.parameters',
        'app.streams',
        'app.designators',
        'app.designators_streams',
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
        $config = TableRegistry::exists('ParameterFunctions') ? [] : ['className' => 'App\Model\Table\ParameterFunctionsTable'];
        $this->ParameterFunctions = TableRegistry::get('ParameterFunctions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ParameterFunctions);

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
