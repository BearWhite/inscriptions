<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Form\SyntheseNavForm;
use Cake\ORM\TableRegistry;

class SyntheseController extends AppController {

    public function index() {

        if (sizeof(TableRegistry::get('Parcours')->find()) == 0) {
            $this->Flash->set('<strong>Information!</strong> Aucun donnée de hiérarchie universitaire de saisie. Impossible d\'afficher la synthése.');
            $this->redirect('dashboard');
        }


        $mentions = TableRegistry::get('Mentions')->find('list');
        $mention_id = (!isset($this->request->query['mention_id'])) ? key($mentions->toArray()) : $this->request->query['mention_id'];

        $specialites = TableRegistry::get('Specialites')
                ->find('list', ['conditions' => ['mention_id' => $mention_id]]);
        $specialite_id = (!isset($this->request->query['specialite_id'])) ? key($specialites->toArray()) : $this->request->query['specialite_id'];

        $annees = array_values(TableRegistry::get('Specialites')->get($specialite_id)->getAnneeBySpecialite()->hydrate(false)->toArray());
        $arr = array();
        foreach ($annees as $annee) {
            $arr[$annee['année']] = $annee['année'];
        }
        $annees = $arr;
        $annee = (!isset($this->request->query['annee'])) ? $annees[key($annees)] : $this->request->query['annee'];

        $parcours = TableRegistry::get('Parcours')
                ->find('list', ['conditions' => ['specialite_id' => $specialite_id, 'année' => $annee]]);
        $parcour_id = (!isset($this->request->query['parcour_id'])) ? key($parcours->toArray()) : $this->request->query['parcour_id'];

        $parcour_title = TableRegistry::get('Parcours')->getFullTitle($parcour_id);

        $typevue = (!isset($this->request->query['typevue'])) ? "groupes" : $this->request->query['typevue'];

        if(strcmp($typevue,"groupes") == 0 ){
            $groupes = TableRegistry::get('Parcours')
                ->get($parcour_id, [
                        'contain' => [
                            'Groupes.Modules',
                            'Groupes.Utilisateurs' =>
                                function($q) use ($parcour_id) {
                                    return $q->where(['Utilisateurs.parcour_id' => $parcour_id]);
                                }
                        ]
                    ]
                )->groupes;
        }else{
            $utilisateurs = TableRegistry::get('Utilisateurs')->find('all', ['contain' => ['Groupes.Modules']])
                ->where(['Utilisateurs.parcour_id'=>$parcour_id])
                ->order(['Utilisateurs.nom' => 'ASC']);
            $groupes_obligatoires = TableRegistry::get('Parcours')->find("all",['contain' =>['Groupes', 'Groupes.Modules' =>
                function ($q) use ($parcour_id) {
                    return $q->where(['Groupes.obligatoire' => true]);
                }
            ]])-> where (['id' => $parcour_id]);

        }



        $this->set(compact(
            'mentions', 'specialites', 'annees', 'parcours', 'mention_id', 'specialite_id', 'annee', 'parcour_id', 'parcour', 'parcour_title', 'groupes', 'typevue','utilisateurs','groupes_obligatoires'
        ));

    }




        }
        