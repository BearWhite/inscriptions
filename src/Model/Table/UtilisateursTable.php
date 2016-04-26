<?php
namespace App\Model\Table;

use App\Model\Entity\Utilisateur;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Utilisateurs Model
 */
class UtilisateursTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('utilisateurs');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id'
        ]);
        $this->belongsTo('Parcours', [
            'foreignKey' => 'parcour_id'
        ]);
        $this->belongsToMany('Groupes', [
            'foreignKey' => 'utilisateur_id',
            'targetForeignKey' => 'groupe_id',
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
            ->requirePresence('prenom', 'create')
            ->notEmpty('prenom')
            ->requirePresence('nom', 'create')
            ->notEmpty('nom')
            ->requirePresence('identifiant', 'create')
            ->notEmpty('identifiant')
            ->requirePresence('motdepasse', 'create')
            ->notEmpty('motdepasse')
            ->add('actif', 'valid', ['rule' => 'boolean'])
            ->requirePresence('actif', 'create')
            ->notEmpty('actif')
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->requirePresence('telephone', 'create')
            ->notEmpty('telephone')
            ->add('role_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('role_id', 'create')
            ->notEmpty('role_id')
            ->add('parcour_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('parcour_id', 'create')
            ->notEmpty('parcour_id');
                ;
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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['identifiant']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        $rules->add($rules->existsIn(['parcour_id'], 'Parcours'));
        return $rules;
    }

    public function getUnvalidatedUsers(){
        $query = $this->find('all',['contain'=>['Parcours.Specialites.Mentions']])
            ->where(['Utilisateurs.actif' => 0]);

        return $query->all();
    }

    public function getUsersWithIds($user_ids){
        $query = $this->find('all')
            ->where(['Utilisateurs.id IN' => $user_ids]);

        return $query->all();
    }

    function validateMultipleAccounts(array $user_ids, $validate)
    {
        if($validate)
            $this->updateAll(['actif' => true], ['id IN' => $user_ids]);
        else
            $this->deleteAll(['id IN' => $user_ids]);
    }

    function getUserChoicesForPeriodId($user_id, $period_id){
        $groupes_utilisateur = $this->get($user_id, ['contain' => ['Groupes']]);

        $gid = [];
        foreach($groupes_utilisateur->groupes as $groupe){
            $gid[] = $groupe->id;
        }

        $groupes = $this->Groupes->find('all',['contain' => ['Modules']])->where(['Groupes.id IN' => $gid, 'Groupes.periode_id' => $period_id]);

        $gid = [];
        foreach($groupes as $groupe){
            $gid[] = $groupe->id;
        }

        return ['ids' => $gid, 'entities' => $groupes->toArray()];
    }
}
