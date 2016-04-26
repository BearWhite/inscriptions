<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Groupes Controller
 *
 * @property \App\Model\Table\GroupesTable $Groupes
 */
class GroupesController extends AppController
{

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->set('title', 'Ajouter un groupe');
        $module = $this->Groupes->Modules->get($this->request->query['module_id']);
        $groupe = $this->Groupes->newEntity();
        if ($this->request->is('post')) {
            $groupe = $this->Groupes->patchEntity($groupe, $this->request->data);
            $groupe->module_id = $module->id;
            if ($this->Groupes->save($groupe)) {
                $this->Flash->success('Le groupe a été correctement ajouté.');
                return $this->redirect(['controller' => 'modules', 'action' => 'view', $module->id]);
            } else {
                $this->Flash->error('Le groupe n\'a pas pu être ajouté. Veuillez corriger les erreurs mentionnées.');
            }
        }
        $parcours = $this->Groupes->Parcours->find();
        $parcours = $this->Groupes->Parcours->find('list', [
            'fields' => [
                'Parcours.title', 'Mentions.title',
                'title' => $parcours->func()->concat([
                    'Mentions.title' => 'literal',
                    ' ▸ ',
                    'Specialites.title' => 'literal',
                    ' ',
                    'Parcours.année' => 'literal',
                    ' ▸ ',
                    'Parcours.title' => 'literal',
                ]),
                'id'
            ],
            'keyField' => 'id',
            'valueField' => 'title',
            'contain' => ['Specialites.Mentions']]);
        $periodes = $this->Groupes->Periodes->find('list');
        $this->set(compact('groupe', 'parcours', 'periodes'));
        $this->set('_serialize', ['groupe']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Groupe id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->set('title', 'Modifier un groupe');
        $groupe = $this->Groupes->get($id, [
            'contain' => ['Periodes', 'Modules', 'Parcours', 'Utilisateurs']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $groupe = $this->Groupes->patchEntity($groupe, $this->request->data);
            if ($this->Groupes->save($groupe)) {
                $this->Flash->success('Le groupe a été correctement modifié.');
                return $this->redirect(['controller' => 'modules', 'action' => 'view', $groupe->module_id]);
            } else {
                $this->Flash->error('Le groupe n\'a pas pu être modifié. Veuillez corriger les erreurs mentionnées.');
            }
        }
        $parcours = $this->Groupes->Parcours->find();
        $parcours = $this->Groupes->Parcours->find('list', [
            'fields' => [
                'Parcours.title', 'Mentions.title',
                'title' => $parcours->func()->concat([
                    'Mentions.title' => 'literal',
                    ' ▸ ',
                    'Specialites.title' => 'literal',
                    ' ',
                    'Parcours.année' => 'literal',
                    ' ▸ ',
                    'Parcours.title' => 'literal',
                ]),
                'id'
            ],
            'keyField' => 'id',
            'valueField' => 'title',
            'contain' => ['Specialites.Mentions']]);
        $periodes = $this->Groupes->Periodes->find('list', ['limit' => 200]);
        $this->set(compact('groupe', 'parcours', 'periodes'));
        $this->set('_serialize', ['groupe']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Groupe id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $groupe = $this->Groupes->get($id);
        if ($this->Groupes->delete($groupe)) {
            $this->Flash->success('Le groupe a été supprimé.');
        } else {
            $this->Flash->error('Un erreur est survenue et le groupe n\'a pas pu être supprimé.');
        }
        return $this->redirect(['controller' => 'modules', 'action' => 'view', $groupe->module_id]);
    }
}
