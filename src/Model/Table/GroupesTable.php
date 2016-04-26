<?php
namespace App\Model\Table;

use App\Model\Entity\Groupe;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Groupes Model
 */
class GroupesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('groupes');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Modules', [
            'foreignKey' => 'module_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Periodes', [
            'foreignKey' => 'periode_id'
        ]);
        $this->belongsToMany('Parcours', [
            'foreignKey' => 'groupe_id',
            'targetForeignKey' => 'parcour_id',
            'joinTable' => 'groupes_parcours'
        ]);
        $this->belongsToMany('Utilisateurs', [
            'foreignKey' => 'groupe_id',
            'targetForeignKey' => 'utilisateur_id',
            'joinTable' => 'groupes_utilisateurs'
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
            ->add('capacite', 'valid', ['rule' => 'numeric'])
            ->requirePresence('capacite', 'create')
            ->notEmpty('capacite')
            ->add('obligatoire', 'valid', ['rule' => 'boolean'])
            ->requirePresence('obligatoire', 'create')
            ->notEmpty('obligatoire')
            ->add('parcours', 'custom', [
                'rule' => function($value) {
                    return (!empty($value['_ids']) && is_array($value['_ids']));
                },
                'message' => 'Vous devez sélectionner au moins un parcours !'
            ]);

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
        $rules->add($rules->existsIn(['module_id'], 'Modules'));
        return $rules;
    }
}
