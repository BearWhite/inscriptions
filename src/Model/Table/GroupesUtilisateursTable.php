<?php
namespace App\Model\Table;

use App\Model\Entity\GroupesUtilisateur;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GroupesUtilisateurs Model
 */
class GroupesUtilisateursTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('groupes_utilisateurs');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Utilisateurs', [
            'foreignKey' => 'utilisateur_id'
        ]);
        $this->belongsTo('Groupes', [
            'foreignKey' => 'groupe_id'
        ]);
        $this->addBehavior('Timestamp');
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
            ->add('utilisateur_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('utilisateur_id', 'create')
            ->notEmpty('utilisateur_id')
            ->add('groupe_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('groupe_id', 'create')
            ->notEmpty('groupe_id');

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
        $rules->add($rules->existsIn(['utilisateur_id'], 'Utilisateurs'));
        $rules->add($rules->existsIn(['groupe_id'], 'Groupes'));
        return $rules;
    }

    public function getPlacesOccupees($id_parcours){
        $query = $this->find();
        $result = $query->find('list',[
            'keyField' => 'groupe_id',
            'valueField' => 'takenSeats',
            'group' => 'GroupesUtilisateurs.groupe_id'])
            ->contain(['Groupes'])
            ->join([
                'gp' => [
                    'table' => 'groupes_parcours',
                    'type' => 'LEFT',
                    'conditions' => 'gp.groupe_id = GroupesUtilisateurs.groupe_id',
                ]
            ])
            ->select([
                'GroupesUtilisateurs.groupe_id',
                'takenSeats' => $query->func()->count('GroupesUtilisateurs.groupe_id')
            ])
            ->where(['gp.parcour_id' => $id_parcours, 'Groupes.obligatoire' => 0])
            ->toArray();

        return $result;
    }
}
