<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmployeursTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmployeursTable Test Case
 */
class EmployeursTableTest extends TestCase
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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Employeurs') ? [] : ['className' => 'App\Model\Table\EmployeursTable'];
        $this->Employeurs = TableRegistry::get('Employeurs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Employeurs);

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
