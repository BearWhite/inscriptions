<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GroupesParcoursTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GroupesParcoursTable Test Case
 */
class GroupesParcoursTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'GroupesParcours' => 'app.groupes_parcours',
        'Groupes' => 'app.groupes',
        'Modules' => 'app.modules',
        'GroupesModules' => 'app.groupes_modules',
        'Parcours' => 'app.parcours',
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
        $config = TableRegistry::exists('GroupesParcours') ? [] : ['className' => 'App\Model\Table\GroupesParcoursTable'];
        $this->GroupesParcours = TableRegistry::get('GroupesParcours', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GroupesParcours);

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
