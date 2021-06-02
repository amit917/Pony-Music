<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssetsBookingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssetsBookingsTable Test Case
 */
class AssetsBookingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AssetsBookingsTable
     */
    public $AssetsBookings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.AssetsBookings',
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
        $config = TableRegistry::getTableLocator()->exists('AssetsBookings') ? [] : ['className' => AssetsBookingsTable::class];
        $this->AssetsBookings = TableRegistry::getTableLocator()->get('AssetsBookings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssetsBookings);

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
