<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GroupesUtilisateur Entity.
 */
class GroupesUtilisateur extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'utilisateur_id' => true,
        'groupe_id' => true,
        'utilisateur' => true,
        'groupe' => true,
    ];
}
