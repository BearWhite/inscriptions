<?php
namespace App\Test\TestCase\Controller;

use App\Controller\SpecialitesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SpecialitesController Test Case
 */
class SpecialitesControllerTest extends IntegrationTestCase
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
