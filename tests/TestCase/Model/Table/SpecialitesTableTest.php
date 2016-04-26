<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SpecialitesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SpecialitesTable Test Case
 */
class SpecialitesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Specialites' => 'app.specialites',
        'Mentions' => 'app.mentions',
        'Parcours' => 'app.parcours',
        'Utilisateurs' => 'app.utilisateurs',
        'Roles' => 'app.roles',
        'Groupes' => 'app.groupes',
        'Modules' => 'app.modules',
        'Periodes' => 'app.periodes',
        'GroupesModules' => 'app.groupes_modules',
        'GroupesParcours' => 'app.groupes_parcours',
        'GroupesUtilisateurs' => 'app.groupes_utilisateurs',
        'ParcoursSpecialites' => 'app.parcours_specialites'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Specialites') ? [] : ['className' => 'App\Model\Table\SpecialitesTable'];
        $this->Specialites = TableRegistry::get('Specialites', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Specialites);

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
