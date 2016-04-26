<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PeriodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PeriodesTable Test Case
 */
class PeriodesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Periodes' => 'app.periodes',
        'Modules' => 'app.modules',
        'Groupes' => 'app.groupes',
        'GroupesModules' => 'app.groupes_modules',
        'Parcours' => 'app.parcours',
        'Utilisateurs' => 'app.utilisateurs',
        'GroupesParcours' => 'app.groupes_parcours',
        'Specialites' => 'app.specialites',
        'ParcoursSpecialites' => 'app.parcours_specialites',
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
        $config = TableRegistry::exists('Periodes') ? [] : ['className' => 'App\Model\Table\PeriodesTable'];
        $this->Periodes = TableRegistry::get('Periodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Periodes);

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
}
