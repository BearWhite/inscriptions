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

use App\Model\Entity\Utilisateur;
use App\Model\Table\RolesTable;
use App\Model\Table\ParcoursTable;
use Cake\Controller\Component\AuthComponent;
use Cake\Controller\Controller;
use App\Controller\AppController;
use Cake\Datasource\ResultSetInterface;
use Cake\Network\Email\Email;
use Cake\ORM\Role;
use Cake\ORM\Parcours;
use Cake\Event\Event;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class UtilisateursController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow('inscription');
        $this->Auth->allow('connexion');
        $this->Auth->allow('deconnexion');

    }

    public function isAuthorized($user)
    {
        $roles = TableRegistry::get('Roles')->find('list')->toArray();

        //L'étudiant peut accéder au choix
        if (isset($user['role_id']) && $roles[$user['role_id']] === 'Etudiant' && $this->request->action === 'faireChoix') {
            return true;
        }

        //L'étudiant peut accéder à son profil, et la modification de mot de passe
        if (isset($user['role_id']) && in_array($roles[$user['role_id']], ['Etudiant','Professeur']) &&
            in_array($this->request->action, ['details', 'modification', 'modification_mdp']) &&
            $this->request->params['pass'][0] == $user['id']
        ) {
            return true;
        }

        if (isset($user['role_id']) && $roles[$user['role_id']] === 'Administrateur' && $this->request->action !== 'faireChoix') {
            return true;
        }

        return parent::isAuthorized($user);
    }

    public function initialize() {
        parent::initialize();
    }

    public $paginate = [
        'limit' => 15,
        'order' => [
            'Utilisateurs.id' => 'asc'
        ]
    ];

    public function index()
    {
        $this->loadModel('Roles');
        $users = $this->Utilisateurs->find('all')->contain(['Roles', 'Parcours.Specialites.Mentions']);

        $this->set('users',$users);
    }

    public function inscription() {

        $user = $this->Utilisateurs->newEntity();

        if ($this->request->is('post')) {
            $role = $this->Utilisateurs->Roles->find('all', ['conditions' => ['title' => 'Etudiant']])->first();

            $user = $this->Utilisateurs->newEntity($this->request->data);
            $user->actif = 0;
            $user->role_id = $role->id;

            if ($this->Utilisateurs->save($user)) {
                $this->Flash->success(__("Votre compte a été créé, il doit maintenant être validé par l'administrateur."));
                $email = new Email('default');
                $email->from(['noreply@mastersticamiens.fr' => 'GICO'])
                        ->to($user->email)
                        ->subject('Inscription optionnelles MAster STIC')
                        ->send('Bonjour ' . $user->prenom . ' ' . $user->nom . ', Vous avez déposé une demande d\'ouverture de compte pour vos choix d\'options en Master STIC.
						Vous recevrez un mail de confirmation de l\'activation de votre compte. 
						En cas de non activation le matin de l\'ouverture des choix, contactez-moi.
						Cordialement, 
						Gwenaelle Berquin
						gwenaelle.berquin@u-picardie.fr');
                return $this->redirect('/');
            }
            $this->Flash->error(__("Impossible d'ajouter l'utilisateur."));
        }
        $parcours = $this->Utilisateurs->Parcours->getParcoursFullTitle();
        $this->set(compact('user', 'parcours'));

        $this->render();
    }

    public function connexion()
    {
        $this->set('title', 'Se connecter');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(
                    array('controller' => 'dashboard', 'action' => 'index')
                );
            }
            $this->Flash->error(__("Nom d'utilisateur ou mot de passe incorrect, il est également possible que votre compte soit désactivé."));
        }
    }

    public function deconnexion()
    {
        $this->Auth->logout();
        return $this->redirect('/');
    }

    public function validationMutliple()
    {
        if ($this->request->is('post')) {
            if(count($this->request->data()) >= 2){
                $posted_data = $this->request->data();

                if(array_key_exists('validate', $posted_data)){
                    $validate = true;
                    $this->Flash->set(__('Les utilisateurs ont été correctement validés','success'));
                }elseif(array_key_exists('delete', $posted_data)){
                    $validate = false;
                    $this->Flash->set(__('Les utilisateurs ont été correctement supprimés','error'));
                }
                else
                    throw new BadRequestException();

                array_pop($posted_data); //On supprime le submit
                $users_id = array_keys($posted_data); //On récupère les ids

                $this->Utilisateurs->validateMultipleAccounts($users_id, $validate);

                $utilisteurs = $this->Utilisateurs->getUsersWithIds($users_id);

                foreach($utilisteurs as $entity)
                    $this->sendEndValidationProcess($entity, $validate);

                $this->redirect('/dashboard');
            }else{
                $this->Flash->set(__('Vous devez au moins sélectionner un utilisateur !'));
                $this->redirect('/dashboard');
            }
        }else{
            throw new MethodNotAllowedException();
        }
    }

    private function sendEndValidationProcess(Utilisateur $user, $isValidated){

        if($isValidated)
            $content = 'Bonjour ' . $user->prenom . ' ' . $user->nom . ',

            Votre compte sur la plateforme de choix des optionelles en Master STIC a été activé par un administrateur. 
			Faites un test de connexion avant l\'heure d\'ouverture des choix.

            Cordialement, 
			Gwenaelle Berquin
			gwenaelle.berquin@u-picardie';
        else
            $content = 'Bonjour ' . $user->prenom . ' ' . $user->nom . ',

            Votre compte sur la plateforme GICO a été refusé par un administrateur.
            Si vous pensez qu\'il s\'agit d\'une erreur, n\'hésitez pas à contacter l\'administrateur.

            A bientôt, GICO.';

        $email = new Email('default');
        $email->from(['noreply@mastersticamiens.fr' => 'GICO'])
            ->to($user->email)
            ->subject('GICO Inscription')
            ->send($content);
    }

    public function suppression($id)
    {
        if(!empty($id)){
            $userToRemove = $this->Utilisateurs->get($id);
            if ($this->Utilisateurs->delete($userToRemove)) {
                $this->Flash->success(__("L'utilisateur a été supprimé."));

            }else{
                $this->Flash->error(__("L'utilisateur n'a pas pu être supprimé."));
            }
        }
        return $this->redirect(
            array('controller' => 'utilisateurs', 'action' => 'index')
        );
    }


    public function modification($id = null)
    {
        /*$utilisateur = $this->Utilisateurs->get($id, [
            'contain' => ['Roles']
        ]);*/
        $utilisateur = $this->Utilisateurs->get($id, 
            array('contain' => ['Parcours', 'Roles', 'Groupes.Modules', 'Groupes.Periodes'])
        );
        
        $this->set('parcours', $utilisateur->parcour_id);

        //On récupère les modules accessibles à l'utilisateur en fonction des groupes disponibles pour son parcours.
        $groupes_parcours = TableRegistry::get('GroupesParcours');
        $groupes = TableRegistry::get('GroupesParcours')->getAvailibleOptionsGroupsForParcoursId($utilisateur->parcour_id);

        
        $periodes = [];
        foreach($groupes as $groupe){
            $periodes[$groupe->groupe->periode->id]['periode'] = $groupe->groupe->periode;
            $periodes[$groupe->groupe->periode->id]['choix'] = $this->Utilisateurs->getUserChoicesForPeriodId($utilisateur->id, $groupe->groupe->periode->id);
            $periodes[$groupe->groupe->periode->id]['groupes'][] = $groupe->groupe;
        }

        $this->set(compact('periodes', 'placesDispo'));
        
        $parcours = $this->Utilisateurs->Parcours->getParcoursFullTitle();
        $this->set(compact('user', 'parcours'));
           
        if ($this->request->is(['patch', 'post', 'put'])) {

            $utilisateur = $this->Utilisateurs->patchEntity($utilisateur, $this->request->data);
            if ($this->Utilisateurs->save($utilisateur)) {
                //On s'assure que l'utilisateur à bien sélectionné le nombre requis de groupes
                if(count($this->request->data('groupes')) !== 0){
                    foreach($periodes as $periode):
                        $choix = $this->Utilisateurs->getUserChoicesForPeriodId($utilisateur->id, $periode['periode']->id);
                    
                        //On supprime les éventuels anciens choix d'options
                        if(count($choix['ids']) > 0){
                            $groupes = $this->Utilisateurs->Groupes->find()->where(['id IN' => $choix['ids']])->toArray();
                            $this->Utilisateurs->Groupes->unlink($utilisateur,$groupes);
                        }
        
                    endforeach;
                    
                    //On enregistre les choix
                    $groupes = [];
                    foreach($this->request->data('groupes') as $groupe_id){
                        $groupes[] = $this->Utilisateurs->Groupes->get($groupe_id);
                    }
                    $this->Utilisateurs->Groupes->link($utilisateur, $groupes);
                }
                
                $this->Flash->success($reponse);
                return $this->redirect(['action' => 'details', $utilisateur->id]);
            } else {
                $this->Flash->error('L\'utilisateur n\'a pas pu être enregistré');
            }
        }
        $this->set('user',$utilisateur);
    }

    public function modification_mdp($id = null){

        $user = $this->Utilisateurs->get($id);

        if($this->request->is(['put','patch','post'])){
            if($this->request->data['motdepasse'] == $this->request->data['password']) {
                $userToSave = $this->Utilisateurs->patchEntity($user, $this->request->data);
                if ($this->Utilisateurs->save($userToSave)) {
                    $this->Flash->success("Le mot de passe de l'utilisateur a bien été enregistré");
                    return $this->redirect(['action' => 'details', $user->id]);
                } else {
                    $this->Flash->error("Le mot de passe de l'utilisateur n'a pas pu être enregistré correctement");
                }
            }else{
                $this->Flash->error("Les deux mots passe entrés ne sont pas identiques,veuillez les saisir de nouveau");
            }
        }
        $this->set('user',$user);
    }

    public function activation_utilisateur($id)
    {
        if(!empty($id)) {
            $user = $this->Utilisateurs->get($id);
            $user->actif = true;
        }
        $this->render('liste');
    }

    public function details($id = null)
    {
        $user = $this->Utilisateurs->get($id, array('contain' => ['Parcours', 'Roles', 'Groupes.Modules', 'Groupes.Periodes']));
        $this->set("user", $user);
    }

    public function faireChoix(){

        //On récupère l'utilisateur connecté.
        $utilisateur = $this->Utilisateurs->get($this->Auth->user("id"), ['contain' => ['Parcours']]);

        $this->set('parcours', $utilisateur->parcour->getFullTitle());

        //On récupère les modules accessibles à l'utilisateur en fonction des groupes disponibles pour son parcours.
        $groupes_parcours = TableRegistry::get('GroupesParcours');
        $groupes = TableRegistry::get('GroupesParcours')->getAvailibleOptionsGroupsForParcoursId($utilisateur->parcour_id);

        $periodes = [];
        foreach($groupes as $groupe){
            $periodes[$groupe->groupe->periode->id]['periode'] = $groupe->groupe->periode;
            $periodes[$groupe->groupe->periode->id]['choix'] = $this->Utilisateurs->getUserChoicesForPeriodId($utilisateur->id, $groupe->groupe->periode->id);
            $periodes[$groupe->groupe->periode->id]['groupes'][] = $groupe->groupe;
        }

        $placesDispo = [];
        foreach($groupes as $groupe){
            $placesDispo[$groupe->groupe->id] = $groupe->groupe->placeDispo;
        }

        $this->set(compact('periodes', 'placesDispo'));

        if($this->request->is('post')){
            $period = $this->Utilisateurs->Parcours->Groupes->Periodes->get($this->request->data('period_id'));

            //On ne garde que les groupes sélectionnés
            $placesDispo = array_intersect_key($placesDispo,array_flip($this->request->data('groupes')));
            $choix = $this->Utilisateurs->getUserChoicesForPeriodId($utilisateur->id, $this->request->data('period_id'));
            foreach($placesDispo as $gid => $places){
                if(in_array($gid, $choix['ids'])) $placesDispo[$gid] = $placesDispo[$gid] + 1;
            }

            //On s'assure que l'utilisateur à bien sélectionné le nombre requis de groupes
            if(count($this->request->data('groupes')) < $period->nb_options){
                $this->Flash->warning('Attention ! Votre choix n\'a pas été enregistré, vous devez sélectionner exactement ' . $period->nb_options . ' options. Merci de faire de nouveau votre choix.');
            //On revérifie qu'il reste toujours des places disponibles pour chaque groupe sélectionné
            }elseif(count(array_keys($placesDispo,0)) > 0){
                $this->Flash->warning('Attention ! Votre choix n\'a pas été enregistré car il ne reste plus de place disponible pour l\'une des options sélectionnées. Merci de faire de nouveau votre choix.');
            }else{
                //On supprime les éventuels anciens choix d'options
                if(count($choix['ids']) > 0){
                    $groupes = $this->Utilisateurs->Groupes->find()->where(['id IN' => $choix['ids']])->toArray();
                    $this->Utilisateurs->Groupes->unlink($utilisateur,$groupes);
                }

                //On enregistre les choix
                $groupes = [];
                foreach($this->request->data('groupes') as $groupe_id){
                    $groupes[] = $this->Utilisateurs->Groupes->get($groupe_id);
                }
                $this->Utilisateurs->Groupes->link($utilisateur, $groupes);

                $this->Flash->success('Votre choix d\'options a été correctement enregistré');
                $this->Redirect(['controller' => 'utilisateurs', 'action' => 'faireChoix']);
            }
        }
    }

    public function valider() {
        $utilisateurs = $this->Utilisateurs->getUnvalidatedUsers();
        $this->set(compact('utilisateurs'));
    }
}
