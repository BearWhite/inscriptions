<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ParcoursTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ParcoursTable Test Case
 */
class ParcoursTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Parcours' => 'app.parcours',
        'Specialites' => 'app.specialites',
        'Mentions' => 'app.mentions',
        'Utilisateurs' => 'app.utilisateurs',
        'Roles' => 'app.roles',
        'Groupes' => 'app.groupes',
        'Modules' => 'app.modules',
        'Periodes' => 'app.periodes',
        'GroupesModules' => 'app.groupes_modules',
        'GroupesParcours' => 'app.groupes_parcours',
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
        $config = TableRegistry::exists('Parcours') ? [] : ['className' => 'App\Model\Table\ParcoursTable'];
        $this->Parcours = TableRegistry::get('Parcours', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Parcours);

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
