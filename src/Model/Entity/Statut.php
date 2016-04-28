<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Periode Entity.
 */
class Periode extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'intitule' => true,
        'heuresmax' => true,
        'typeenseignement' => true,
    ];

}
