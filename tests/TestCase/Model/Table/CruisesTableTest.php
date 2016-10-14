<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CruisesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CruisesTable Test Case
 */
class CruisesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CruisesTable
     */
    public $Cruises;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cruises'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Cruises') ? [] : ['className' => 'App\Model\Table\CruisesTable'];
        $this->Cruises = TableRegistry::get('Cruises', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cruises);

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
