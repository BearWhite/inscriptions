<?php
namespace App\Model\Table;

use App\Model\Entity\Periode;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Periodes Model
 */
class PeriodesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('periodes');
        $this->displayField('fullTitle');
        $this->primaryKey('id');
        $this->hasMany('Groupes', [
            'foreignKey' => 'periode_id'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title')
            ->requirePresence('public_title', 'create')
            ->notEmpty('public_title')
            ->add('nb_options', 'valid', ['rule' => 'numeric'])
            ->notEmpty('nb_options')
            ->notEmpty('date_debut')
            ->notEmpty('date_fin')
            ->notEmpty('date_debut_choix')
            ->notEmpty('date_fin_choix');

        return $validator;
    }
}
