<?php

namespace App\Model\Table;

use App\Model\Entity\Parcour;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parcours Model
 */
class ParcoursTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('parcours');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->belongsTo('Specialites', [
            'foreignKey' => 'specialite_id',
            'joinType' => 'INNER'  ,
        ]);
        $this->hasMany('Utilisateurs', [
            'foreignKey' => 'parcour_id'
        ]);
        $this->belongsToMany('Groupes', [
            'foreignKey' => 'parcour_id',
            'targetForeignKey' => 'groupe_id',
            'joinTable' => 'groupes_parcours'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->add('id', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('id', 'create')
                ->requirePresence('title', 'create')
                ->notEmpty('title')
                ->add('année', 'valid', ['rule' => 'numeric'])
                ->requirePresence('année', 'create')
                ->notEmpty('année');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['specialite_id'], 'Specialites'));
        return $rules;
    }

    public function getFullTitle($parcour_id) {
        $parcour = $this->get($parcour_id, ['contain' => ['Specialites.Mentions']]);
        if ($parcour->année !== 0) {
            return sprintf('%s ▸ %s %s ▸ %s', $parcour->specialite->mention->title, $parcour->specialite->title, $parcour->année, $parcour->title);
        } else {
            return sprintf('%s', $parcour->title);    
        }
    }

    public function getParcoursFullTitle() {
        $parcours = $this->find('all', ['limit' => 200, 'contain' => ['Specialites.Mentions']]);
        $list = [];
        foreach ($parcours as $entity) {
            if ($entity->année !== 0) {
                $list[$entity->id] = sprintf('%s ▸ %s %s ▸ %s', $entity->specialite->mention->title, $entity->specialite->title, $entity->année, $entity->title);
            } else {
                $list[$entity->id] = sprintf('%s', $entity->title);
            }
        }
        return $list;
    }

}
