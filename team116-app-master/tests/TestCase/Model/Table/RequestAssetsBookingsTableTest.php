<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequestAssetsBookingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequestAssetsBookingsTable Test Case
 */
class RequestAssetsBookingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RequestAssetsBookingsTable
     */
    public $RequestAssetsBookings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RequestAssetsBookings',
        'app.Assets',
        'app.Bookings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RequestAssetsBookings') ? [] : ['className' => RequestAssetsBookingsTable::class];
        $this->RequestAssetsBookings = TableRegistry::getTableLocator()->get('RequestAssetsBookings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RequestAssetsBookings);

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
