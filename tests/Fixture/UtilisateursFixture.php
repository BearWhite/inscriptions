<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UtilisateursFixture
 *
 */
class UtilisateursFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'prenom' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'nom' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'identifiant' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'motdepasse' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'actif' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'oui/non', 'precision' => null],
        'email' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'telephone' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'role_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'parcour_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_utilisateurs_roles_idx' => ['type' => 'index', 'columns' => ['role_id'], 'length' => []],
            'fk_utilisateurs_parcours1_idx' => ['type' => 'index', 'columns' => ['parcour_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_utilisateurs_parcours1' => ['type' => 'foreign', 'columns' => ['parcour_id'], 'references' => ['parcours', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_utilisateurs_roles' => ['type' => 'foreign', 'columns' => ['role_id'], 'references' => ['roles', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'prenom' => 'Lorem ipsum dolor sit amet',
            'nom' => 'Lorem ipsum dolor sit amet',
            'identifiant' => 'Lorem ipsum dolor sit amet',
            'motdepasse' => 'Lorem ipsum dolor sit amet',
            'actif' => 1,
            'email' => 'Lorem ipsum dolor sit amet',
            'telephone' => 'Lorem ipsum dolor sit amet',
            'role_id' => 1,
            'parcour_id' => 1
        ],
    ];
}
