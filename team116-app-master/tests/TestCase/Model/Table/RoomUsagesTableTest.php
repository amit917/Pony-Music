<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoomUsagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoomUsagesTable Test Case
 */
class RoomUsagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RoomUsagesTable
     */
    public $RoomUsages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RoomUsages',
        'app.Rooms',
        'app.$bookings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RoomUsages') ? [] : ['className' => RoomUsagesTable::class];
        $this->RoomUsages = TableRegistry::getTableLocator()->get('RoomUsages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoomUsages);

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
