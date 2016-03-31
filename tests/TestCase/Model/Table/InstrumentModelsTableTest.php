<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InstrumentModelsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InstrumentModelsTable Test Case
 */
class InstrumentModelsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InstrumentModelsTable
     */
    public $InstrumentModels;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.instrument_models'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('InstrumentModels') ? [] : ['className' => 'App\Model\Table\InstrumentModelsTable'];
        $this->InstrumentModels = TableRegistry::get('InstrumentModels', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InstrumentModels);

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
