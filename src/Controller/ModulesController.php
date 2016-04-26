<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Modules Controller
 *
 * @property \App\Model\Table\ModulesTable $Modules
 */
class ModulesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('title', 'Liste des modules');
        $this->set('modules', $this->Modules->find('all',['order'=>'code','contain'=>['Groupes']]));
        $this->set('_serialize', ['modules']);
    }

    /**
     * View method
     *
     * @param string|null $id Module id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $module = $this->Modules->get($id, [
            'contain' => ['Groupes.Periodes', 'Groupes.Parcours.Specialites.Mentions']
        ]);
        $this->set('module', $module);
        $this->set('_serialize', ['module']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->set('title', 'Nouveau module');
        $module = $this->Modules->newEntity();
        if ($this->request->is('post')) {
            $module = $this->Modules->patchEntity($module, $this->request->data);
            if ($this->Modules->save($module)) {
                $this->Flash->success('La module a été correctement ajouté.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Le module n\'a pas pu être ajouté. Veuillez corriger les erreurs mentionnées.');
            }
        }
        $this->set(compact('module'));
        $this->set('_serialize', ['module']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Module id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->set('title', 'Modifier un module');
        $module = $this->Modules->get($id, [
            'contain' => ['Groupes']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $module = $this->Modules->patchEntity($module, $this->request->data);
            if ($this->Modules->save($module)) {
                $this->Flash->success('Le module a été correctement modifié.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Le module n\'a pas pu être modifié. Veuillez corriger les erreurs mentionnées.');
            }
        }
        $groupes = $this->Modules->Groupes->find('list', ['limit' => 200]);
        $this->set(compact('module', 'groupes'));
        $this->set('_serialize', ['module']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Module id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $module = $this->Modules->get($id);
        if ($this->Modules->delete($module)) {
            $this->Flash->success('Le module a été supprimé.');
        } else {
            $this->Flash->error('Le module n\'a pas pu être supprimé.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
