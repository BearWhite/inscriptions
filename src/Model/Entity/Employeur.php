<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employeur Entity.
 */
class Employeur extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'intitule' => true,
        'upjv' => true,
        'prive' => true,
        'utilisateurs' => true,
    ];
}
