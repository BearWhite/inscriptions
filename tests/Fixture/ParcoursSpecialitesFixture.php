<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ParcoursSpecialitesFixture
 *
 */
class ParcoursSpecialitesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'specialites_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'parcour_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_parcours_specialites_specialites1_idx' => ['type' => 'index', 'columns' => ['specialites_id'], 'length' => []],
            'fk_parcours_specialites_parcours1_idx' => ['type' => 'index', 'columns' => ['parcour_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_parcours_specialites_parcours1' => ['type' => 'foreign', 'columns' => ['parcour_id'], 'references' => ['parcours', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_parcours_specialites_specialites1' => ['type' => 'foreign', 'columns' => ['specialites_id'], 'references' => ['specialites', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'specialites_id' => 1,
            'parcour_id' => 1
        ],
    ];
}
