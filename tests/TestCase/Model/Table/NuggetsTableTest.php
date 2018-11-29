<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NuggetsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NuggetsTable Test Case
 */
class NuggetsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NuggetsTable
     */
    public $Nuggets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.nuggets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Nuggets') ? [] : ['className' => NuggetsTable::class];
        $this->Nuggets = TableRegistry::get('Nuggets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Nuggets);

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
