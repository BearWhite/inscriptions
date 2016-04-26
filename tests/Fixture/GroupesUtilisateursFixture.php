<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GroupesUtilisateursFixture
 *
 */
class GroupesUtilisateursFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'utilisateur_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'groupe_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_groupes_utilisateurs_utilisateurs1_idx' => ['type' => 'index', 'columns' => ['utilisateur_id'], 'length' => []],
            'fk_groupes_utilisateurs_groupes1_idx' => ['type' => 'index', 'columns' => ['groupe_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_groupes_utilisateurs_groupes1' => ['type' => 'foreign', 'columns' => ['groupe_id'], 'references' => ['groupes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_groupes_utilisateurs_utilisateurs1' => ['type' => 'foreign', 'columns' => ['utilisateur_id'], 'references' => ['utilisateurs', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'utilisateur_id' => 1,
            'groupe_id' => 1
        ],
    ];
}
