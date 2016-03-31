<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InstrumentClassesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InstrumentClassesTable Test Case
 */
class InstrumentClassesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InstrumentClassesTable
     */
    public $InstrumentClasses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.instrument_classes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('InstrumentClasses') ? [] : ['className' => 'App\Model\Table\InstrumentClassesTable'];
        $this->InstrumentClasses = TableRegistry::get('InstrumentClasses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InstrumentClasses);

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
