<?php
namespace App\Model\Table;

use App\Model\Entity\GroupesModule;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GroupesModules Model
 */
class GroupesModulesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('groupes_modules');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Groupes', [
            'foreignKey' => 'groupe_id'
        ]);
        $this->belongsTo('Modules', [
            'foreignKey' => 'module_id'
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
            ->add('module_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('module_id', 'create')
            ->notEmpty('module_id');

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
        $rules->add($rules->existsIn(['module_id'], 'Modules'));
        return $rules;
    }
}
