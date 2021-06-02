<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CheckoutTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CheckoutTable Test Case
 */
class CheckoutTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CheckoutTable
     */
    public $Checkout;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Checkout',
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
        $config = TableRegistry::getTableLocator()->exists('Checkout') ? [] : ['className' => CheckoutTable::class];
        $this->Checkout = TableRegistry::getTableLocator()->get('Checkout', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Checkout);

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
