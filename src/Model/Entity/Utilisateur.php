<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Utilisateur Entity.
 */
class Utilisateur extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'prenom' => true,
        'nom' => true,
        'identifiant' => true,
        'motdepasse' => true,
        'actif' => true,
        'email' => true,
        'telephone' => true,
        'role_id' => true,
        'parcour_id' => true,
        'role' => true,
        'parcour' => true,
        'groupes' => true,
		'statut_id' => true,
		'employeur_id' => true,
		'nouveau' => true,
    ];
    
    protected function _setMotdepasse($motdepasse)
    {
        return (new DefaultPasswordHasher)->hash($motdepasse);
    }
}
