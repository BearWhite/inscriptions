<?php

namespace App\Model\Table;

use App\Model\Entity\Specialite;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Specialites Model
 */
class SpecialitesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('specialites');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->belongsTo('Mentions', [
            'foreignKey' => 'mention_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Parcours', [
            'foreignKey' => 'specialite_id',
            'dependent' => true,
            'cascadeCallbacks' => true
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
                ->notEmpty('title');

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
        $rules->add($rules->existsIn(['mention_id'], 'Mentions'));
        return $rules;
    }

    public function getFullTitle($specialite_id) {
        $specialite = $this->get($specialite_id, ['contain' => ['Mentions']]);
        return sprintf('%s ▸ %s', $specialite->mention->title, $specialite->title);
    }


}
