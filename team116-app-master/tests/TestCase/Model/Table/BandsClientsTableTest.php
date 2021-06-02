<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BandsClientsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BandsClientsTable Test Case
 */
class BandsClientsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BandsClientsTable
     */
    public $BandsClients;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.BandsClients',
        'app.Bands',
        'app.Clients',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BandsClients') ? [] : ['className' => BandsClientsTable::class];
        $this->BandsClients = TableRegistry::getTableLocator()->get('BandsClients', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BandsClients);

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
