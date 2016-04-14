<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CalibrationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CalibrationsTable Test Case
 */
class CalibrationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CalibrationsTable
     */
    public $Calibrations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.calibrations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Calibrations') ? [] : ['className' => 'App\Model\Table\CalibrationsTable'];
        $this->Calibrations = TableRegistry::get('Calibrations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Calibrations);

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
