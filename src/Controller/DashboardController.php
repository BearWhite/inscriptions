<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class DashboardController extends AppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow('inscription');
        $this->Auth->allow('connexion');
    }

    public function isAuthorized($user)
    {
        $roles = TableRegistry::get('Roles')->find('list')->toArray();

        if ($this->request->action === 'index') {
            return true;
        }

        return parent::isAuthorized($user);
    }

    public function index() {
        $roles = TableRegistry::get('Roles')->find('list')->toArray();
        $role_id = $this->Auth->user('role_id');
        if (isset($role_id) && $roles[$role_id] === 'Etudiant') {
            return $this->redirect(['controller' => 'Utilisateurs', 'action' => 'faireChoix']);
        }

        $tablePeriodes = TableRegistry::get('Periodes');
        $tableMentions = TableRegistry::get('Mentions');
        $tableSpecialites = TableRegistry::get('Specialites');
        $tableParcours = TableRegistry::get('Parcours');
        $tableModules = TableRegistry::get('Modules');
        $tableUtilisateurs = TableRegistry::get('Utilisateurs');
        $unvalidated_users = $tableUtilisateurs->getUnvalidatedUsers()->count();

        $nb_periodes = $tablePeriodes->find('all')->count();
        $nb_utilisateurs = $tableUtilisateurs->find('all')->count();
        $nb_mentions = $tableMentions->find('all')->count();
        $nb_specialites = $tableSpecialites->find('all')->count();
        $nb_parcours = $tableParcours->find('all')->count();
        $nb_modules = $tableModules->find('all')->count();

        $this->set(compact('nb_periodes', 'nb_mentions', 'nb_specialites', 'nb_parcours', 'nb_modules',
            'nb_utilisateurs', 'unvalidated_users'));

    }


}
