<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Module Entity.
 */
class Module extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'code' => true,
        'title' => true,
        'periode' => true,
        'groupes' => true,
		'nb_heures_cours' => true,
		'nb_heures_td' => true,
		'nb_heures_tp' => true,
		'rermarque' => true,
    ];

    protected function _getFullTitle($title) {

        return $this->_properties['code'] . ' — ' . $this->_properties['title'];
    }

    public function getFullTitle() {
        return $this->code . ' — ' . $this->title;
    }
	
	public function getNbHeuresCours() {
        return $this->nb_heures_cours ;
    }
	
	public function getNbHeuresTd() {
        return $this->nb_heures_td ;
    }
	
	public function getNbHeuresTp() {
        return $this->nb_heures_tp ;
    }
	
	public function getRermarque() {
        return $this->rermarque ;
    }

    public function getUtilisateursFromGroupes($module_id) {
        $arr_utilisateurs = array();
        $module = TableRegistry::get('Modules')
                ->get($module_id, [
            'contain' => [
                'Groupes.Utilisateurs'
            ]
        ]);

        foreach ($module->groupes as $groupe) {
            foreach ($groupe->utilisateurs as $utilisateur) {
                $arr_utilisateurs[] = $utilisateur;
            }
        }

        return $arr_utilisateurs;
    }

    public function getUtilisateursMailsFromGroupes($module_id) {
        $arr_mails = array();
        foreach ($this->getUtilisateursFromGroupes($module_id) as $utilisateur) {
            $arr_mails[] = $utilisateur->email;
        }
        return $arr_mails;
    }

    public function implodeUtilisateursMails($module_id, $copy = 'cc') {
        if ($module_id == null) {
            return null;
        }
        $arr_mails = $this->getUtilisateursMailsFromGroupes($module_id);
        if (count($arr_mails)) {
            $str = 'mailto:' . $arr_mails[0];
            if(count($arr_mails) > 1){
                $str .= '?' . $copy . '=' . $arr_mails[1];
            }
            if(count($arr_mails) > 2){
                $arr_tmp = array_slice($arr_mails, 2, count($arr_mails));
                $str .= '&' . $copy . '=' . implode('&' . $copy . '=', $arr_tmp);
            }
            return $str;
        }else{
            return null;
        }
    }

}
