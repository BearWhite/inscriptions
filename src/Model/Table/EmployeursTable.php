<?php
namespace App\Model\Table;

use App\Model\Entity\Employeur;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employeurs Model
 *
 * @property \Cake\ORM\Association\HasMany $Utilisateurs
 */
class EmployeursTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('employeurs');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->hasMany('Utilisateurs', [
            'foreignKey' => 'employeur_id'
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
            ->allowEmpty('id', 'create');
            
        $validator
            ->requirePresence('intitule', 'create')
            ->notEmpty('intitule');
            
        $validator
            ->add('upjv', 'valid', ['rule' => 'boolean'])
            ->requirePresence('upjv', 'create')
            ->notEmpty('upjv');
            
        $validator
            ->add('prive', 'valid', ['rule' => 'boolean'])
            ->requirePresence('prive', 'create')
            ->notEmpty('prive');

        return $validator;
    }
}
