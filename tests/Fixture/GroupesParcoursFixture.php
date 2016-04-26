<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GroupesParcoursFixture
 *
 */
class GroupesParcoursFixture extends TestFixture
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
        'parcour_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_groupes_parcours_groupes1_idx' => ['type' => 'index', 'columns' => ['groupe_id'], 'length' => []],
            'fk_groupes_parcours_parcours1_idx' => ['type' => 'index', 'columns' => ['parcour_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_groupes_parcours_groupes1' => ['type' => 'foreign', 'columns' => ['groupe_id'], 'references' => ['groupes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_groupes_parcours_parcours1' => ['type' => 'foreign', 'columns' => ['parcour_id'], 'references' => ['parcours', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'parcour_id' => 1
        ],
    ];
}
