<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Parcours Controller
 *
 * @property \App\Model\Table\ParcoursTable $Parcours
 */
class ParcoursController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('title', 'Liste des parcours');
        $parcours = $this->Parcours->find('all',['contain' => ['Specialites.Mentions']]);
        $this->set('parcours', $parcours);
        $this->set('_serialize', ['parcours']);
    }

    /**
     * View method
     *
     * @param string|null $id Parcour id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {

        $parcour = $this->Parcours->get($id, [
            'contain' => ['Specialites', 'Groupes', 'Utilisateurs']
        ]);
        $this->set('parcour', $parcour);
        $this->set('_serialize', ['parcour']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->set('title', 'Nouveau parcours');
        $parcour = $this->Parcours->newEntity();
        if ($this->request->is('post')) {
            $parcour = $this->Parcours->patchEntity($parcour, $this->request->data);
            if ($this->Parcours->save($parcour)) {
                $this->Flash->success('Le parcours a bien été sauvegardé');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Impossible de sauvegarder le parcours');
            }
        }
        $specialites = $this->Parcours->Specialites->find('list', ['limit' => 200]);
        $groupes = $this->Parcours->Groupes->find('list', ['limit' => 200]);
        $this->set(compact('parcour', 'specialites', 'groupes'));
        $this->set('_serialize', ['parcour']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Parcour id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->set('title', 'Modifier un parcours');
        $parcour = $this->Parcours->get($id, [
            'contain' => ['Groupes']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $parcour = $this->Parcours->patchEntity($parcour, $this->request->data);
            if ($this->Parcours->save($parcour)) {
                $this->Flash->success('Le parcours a bien été modifié');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Impossible de modifier le parcours');
            }
        }
        $specialites = $this->Parcours->Specialites->find('list', ['limit' => 200]);
        $groupes = $this->Parcours->Groupes->find('list', ['limit' => 200]);
        $this->set(compact('parcour', 'specialites', 'groupes'));
        $this->set('_serialize', ['parcour']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Parcour id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $parcour = $this->Parcours->get($id);
        if ($this->Parcours->delete($parcour)) {
            $this->Flash->success('Le parcours a bien été supprimé.');
        } else {
            $this->Flash->error('Impossible de supprimer le parcours');
        }
        return $this->redirect(['action' => 'index']);
    }
}
