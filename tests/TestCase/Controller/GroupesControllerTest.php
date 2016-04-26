<?php
namespace App\Test\TestCase\Controller;

use App\Controller\GroupesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\GroupesController Test Case
 */
class GroupesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Groupes' => 'app.groupes',
        'Modules' => 'app.modules',
        'Periodes' => 'app.periodes',
        'GroupesModules' => 'app.groupes_modules',
        'Parcours' => 'app.parcours',
        'Specialites' => 'app.specialites',
        'Mentions' => 'app.mentions',
        'Utilisateurs' => 'app.utilisateurs',
        'Roles' => 'app.roles',
        'GroupesUtilisateurs' => 'app.groupes_utilisateurs',
        'GroupesParcours' => 'app.groupes_parcours'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
