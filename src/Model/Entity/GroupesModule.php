<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GroupesModule Entity.
 */
class GroupesModule extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'groupe_id' => true,
        'module_id' => true,
        'groupe' => true,
        'module' => true,
    ];
}
