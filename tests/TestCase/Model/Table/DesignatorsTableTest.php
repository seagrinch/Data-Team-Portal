<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DesignatorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DesignatorsTable Test Case
 */
class DesignatorsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DesignatorsTable
     */
    public $Designators;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.designators'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Designators') ? [] : ['className' => 'App\Model\Table\DesignatorsTable'];
        $this->Designators = TableRegistry::get('Designators', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Designators);

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
