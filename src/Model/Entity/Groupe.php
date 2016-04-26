<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Groupe Entity.
 */
class Groupe extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'capacite' => true,
        'obligatoire' => true,
        'module_id' => true,
        'periode_id' => true,
        'modules' => true,
        'parcours' => true,
        'utilisateurs' => true,
    ];

    public function getAllUtilisateursFromParcours() {
        $utilisateurs = array();
        
        $groupes = TableRegistry::get('Groupes')->get($this->id, ['contain' => ['Parcours.Utilisateurs']]);
        $utilisateurs_ids = array();

        foreach ($groupes->parcours as $parcour) {
            foreach ($parcour->utilisateurs as $utilisateur) {
                $utilisateurs_ids[] = $utilisateur->id;
            }
        }

        $utilisateurs = TableRegistry::get('Utilisateurs')
                ->find('all')
                ->where(['id IN' => $utilisateurs_ids])
                ->order('nom');
        
        return $utilisateurs;
    }

}
