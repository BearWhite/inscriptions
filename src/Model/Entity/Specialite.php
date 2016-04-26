<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Specialite Entity.
 */
class Specialite extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'mention_id' => true,
        'mention' => true,
        'parcours' => true,
    ];

    public function getAnneeBySpecialite() {
        return \Cake\ORM\TableRegistry::get('Parcours')
                        ->find('all', ['conditions' => ['specialite_id' => $this->id]])
                        ->select(['année'])
                        ->distinct(['année'])
        ;
    }

    public function getFullTitle() {
        $specialite = TableRegistry::get('Specialites')->get($this->id, ['contain' => ['Mentions']]);
        return sprintf('%s ▸ %s', $specialite->mention->title, $specialite->title);
    }

}
