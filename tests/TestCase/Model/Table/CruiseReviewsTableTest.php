<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CruiseReviewsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CruiseReviewsTable Test Case
 */
class CruiseReviewsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CruiseReviewsTable
     */
    public $CruiseReviews;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cruise_reviews'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CruiseReviews') ? [] : ['className' => 'App\Model\Table\CruiseReviewsTable'];
        $this->CruiseReviews = TableRegistry::get('CruiseReviews', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CruiseReviews);

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
