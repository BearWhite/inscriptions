<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ModulesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ModulesTable Test Case
 */
class ModulesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Modules' => 'app.modules',
        'Periodes' => 'app.periodes',
        'Groupes' => 'app.groupes',
        'GroupesModules' => 'app.groupes_modules',
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
        $config = TableRegistry::exists('Modules') ? [] : ['className' => 'App\Model\Table\ModulesTable'];
        $this->Modules = TableRegistry::get('Modules', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Modules);

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
