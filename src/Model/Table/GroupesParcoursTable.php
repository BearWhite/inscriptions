<?php
namespace App\Model\Table;

use App\Model\Entity\GroupesParcour;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * GroupesParcours Model
 */
class GroupesParcoursTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('groupes_parcours');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Groupes', [
            'foreignKey' => 'groupe_id'
        ]);
        $this->belongsTo('Parcours', [
            'foreignKey' => 'parcour_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->add('groupe_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('groupe_id', 'create')
            ->notEmpty('groupe_id')
            ->add('parcour_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('parcour_id', 'create')
            ->notEmpty('parcour_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['groupe_id'], 'Groupes'));
        $rules->add($rules->existsIn(['parcour_id'], 'Parcours'));
        return $rules;
    }

    public function getAvailibleOptionsGroupsForParcoursId($id_parcours){

        //On récupère le nombre de place prises pour chaque groupe correspondant au parcours de l'étudiant
        //on exclut également les groupes ou la présence est obligatoire puisque pas ouverts au choix.
        $placesOccupees = TableRegistry::get('GroupesUtilisateurs')->getPlacesOccupees($id_parcours);

        return $this
            ->find('all',[
                'contain'=>[
                    'Groupes.Modules',
                    'Groupes.Periodes'
                ]
            ])
            ->where(['parcour_id' => $id_parcours, 'obligatoire' => 0])
            ->order('date_debut_choix')
            ->order('Modules.title')
            ->formatResults(function (ResultSetInterface $results) use ($placesOccupees) {
                return $results->map(function ($row) use ($placesOccupees) {
                    $placesOccupees = (isset($placesOccupees[$row->groupe->id])) ? $placesOccupees[$row->groupe->id] : 0;

                    $row->groupe->placeDispo = $row->groupe->capacite - $placesOccupees ;
                    return $row;
                });
            });
    }
}
