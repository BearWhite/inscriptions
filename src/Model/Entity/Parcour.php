<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Parcour Entity.
 */
class Parcour extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'année' => true,
        'specialite_id' => true,
        'specialite' => true,
        'utilisateurs' => true,
        'groupes' => true,
    ];

    public function getFullTitle() {
        $parcour = TableRegistry::get('Parcours')->get($this->id, ['contain' => ['Specialites.Mentions']]);
        if ($parcour->année !== 0) {
            return sprintf('%s ▸ %s %s ▸ %s', $parcour->specialite->mention->title, $parcour->specialite->title, $parcour->année, $parcour->title);
        } else {
            return sprintf('%s', $parcour->title);    
        }
    }

    public function getUtilisateursFromParcours($parcours_id) {
        $arr_utilisateurs = array();
        $parcours = TableRegistry::get('Parcours')
                ->get($parcours_id, [
            'contain' => [
                'Utilisateurs'
            ]
        ]);

        foreach ($parcours->utilisateurs as $utilisateur) {
            $arr_utilisateurs[] = $utilisateur;
        }

        return $arr_utilisateurs;
    }

    public function getUtilisateursMailsFromParcours($parcours_id) {
        $arr_mails = array();
        foreach ($this->getUtilisateursFromParcours($parcours_id) as $utilisateur) {
            $arr_mails[] = $utilisateur->email;
        }
        return $arr_mails;
    }

    public function implodeUtilisateursMails($parcours_id, $copy = 'cc') {
        if ($parcours_id == null) {
            return null;
        }
        $arr_mails = $this->getUtilisateursMailsFromParcours($parcours_id);
        if (count($arr_mails)) {
            $str = 'mailto:' . $arr_mails[0];
            if (count($arr_mails) > 1) {
                $str .= '?' . $copy . '=' . $arr_mails[1];
            }
            if (count($arr_mails) > 2) {
                $arr_tmp = array_slice($arr_mails, 2, count($arr_mails));
                $str .= '&' . $copy . '=' . implode('&' . $copy . '=', $arr_tmp);
            }
            return $str;
        } else {
            return null;
        }
    }

}
