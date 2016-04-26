<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GroupesUtilisateursTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GroupesUtilisateursTable Test Case
 */
class GroupesUtilisateursTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'GroupesUtilisateurs' => 'app.groupes_utilisateurs',
        'Utilisateurs' => 'app.utilisateurs',
        'Groupes' => 'app.groupes',
        'Modules' => 'app.modules',
        'GroupesModules' => 'app.groupes_modules',
        'Parcours' => 'app.parcours',
        'GroupesParcours' => 'app.groupes_parcours'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('GroupesUtilisateurs') ? [] : ['className' => 'App\Model\Table\GroupesUtilisateursTable'];
        $this->GroupesUtilisateurs = TableRegistry::get('GroupesUtilisateurs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GroupesUtilisateurs);

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
