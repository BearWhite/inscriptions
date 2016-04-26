<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ParcoursController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ParcoursController Test Case
 */
class ParcoursControllerTest extends IntegrationTestCase
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
