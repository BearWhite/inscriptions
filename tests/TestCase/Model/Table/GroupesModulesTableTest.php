<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GroupesModulesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GroupesModulesTable Test Case
 */
class GroupesModulesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'GroupesModules' => 'app.groupes_modules',
        'Groupes' => 'app.groupes',
        'Modules' => 'app.modules',
        'Parcours' => 'app.parcours',
        'GroupesParcours' => 'app.groupes_parcours',
        'Utilisateurs' => 'app.utilisateurs',
        'GroupesUtilisateurs' => 'app.groupes_utilisateurs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('GroupesModules') ? [] : ['className' => 'App\Model\Table\GroupesModulesTable'];
        $this->GroupesModules = TableRegistry::get('GroupesModules', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GroupesModules);

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
