<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ModulesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ModulesController Test Case
 */
class ModulesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.modules',
        'app.periodes',
        'app.groupes',
        'app.groupes_modules',
        'app.parcours',
        'app.specialites',
        'app.mentions',
        'app.utilisateurs',
        'app.roles',
        'app.groupes_utilisateurs',
        'app.groupes_parcours'
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
