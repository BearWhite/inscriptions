<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GroupesModulesFixture
 *
 */
class GroupesModulesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'groupe_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'module_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_groupes_modules_groupes1_idx' => ['type' => 'index', 'columns' => ['groupe_id'], 'length' => []],
            'fk_groupes_modules_modules1_idx' => ['type' => 'index', 'columns' => ['module_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_groupes_modules_groupes1' => ['type' => 'foreign', 'columns' => ['groupe_id'], 'references' => ['groupes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_groupes_modules_modules1' => ['type' => 'foreign', 'columns' => ['module_id'], 'references' => ['modules', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
'engine' => 'InnoDB', 'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'groupe_id' => 1,
            'module_id' => 1
        ],
    ];
}
