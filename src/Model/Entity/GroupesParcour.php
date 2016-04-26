<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GroupesParcour Entity.
 */
class GroupesParcour extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'groupe_id' => true,
        'parcour_id' => true,
        'groupe' => true,
        'parcour' => true,
    ];
}
