<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssetUsagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssetUsagesTable Test Case
 */
class AssetUsagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AssetUsagesTable
     */
    public $AssetUsages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.AssetUsages',
        'app.Assets',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AssetUsages') ? [] : ['className' => AssetUsagesTable::class];
        $this->AssetUsages = TableRegistry::getTableLocator()->get('AssetUsages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssetUsages);

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
