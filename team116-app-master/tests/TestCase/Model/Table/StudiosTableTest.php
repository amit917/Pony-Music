<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudiosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudiosTable Test Case
 */
class StudiosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StudiosTable
     */
    public $Studios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Studios',
        'app.Locations',
        'app.Bookings',
        'app.StudioUsages',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Studios') ? [] : ['className' => StudiosTable::class];
        $this->Studios = TableRegistry::getTableLocator()->get('Studios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Studios);

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
