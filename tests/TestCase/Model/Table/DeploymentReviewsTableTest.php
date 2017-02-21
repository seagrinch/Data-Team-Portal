<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DeploymentReviewsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DeploymentReviewsTable Test Case
 */
class DeploymentReviewsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DeploymentReviewsTable
     */
    public $DeploymentReviews;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.deployment_reviews',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DeploymentReviews') ? [] : ['className' => 'App\Model\Table\DeploymentReviewsTable'];
        $this->DeploymentReviews = TableRegistry::get('DeploymentReviews', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DeploymentReviews);

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
