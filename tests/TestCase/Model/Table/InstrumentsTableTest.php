<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InstrumentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InstrumentsTable Test Case
 */
class InstrumentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InstrumentsTable
     */
    public $Instruments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.instruments',
        'app.data_streams'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Instruments') ? [] : ['className' => 'App\Model\Table\InstrumentsTable'];
        $this->Instruments = TableRegistry::get('Instruments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Instruments);

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
