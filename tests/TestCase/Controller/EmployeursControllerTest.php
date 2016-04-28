<?php
namespace App\Test\TestCase\Controller;

use App\Controller\EmployeursController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\EmployeursController Test Case
 */
class EmployeursControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.employeurs',
        'app.utilisateurs',
        'app.roles',
        'app.parcours',
        'app.specialites',
        'app.mentions',
        'app.groupes',
        'app.modules',
        'app.periodes',
        'app.groupes_parcours',
        'app.groupes_utilisateurs'
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
