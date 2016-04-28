<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Periodes Controller
 *
 * @property \App\Model\Table\PeriodesTable $statuts
 */
class StatutsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('statuts', $this->Statuts->find('all'));
        $this->set('_serialize', ['statuts']);
    }

    /**
     * View method
     *
     * @param string|null $id Periode id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $statut = $this->Statuts->get($id);
        $this->set('statut', $statut);
        $this->set('_serialize', ['statut']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $statut = $this->Statuts->newEntity();
        if ($this->request->is('post')) {
            $statut = $this->Statuts->patchEntity($statut, $this->request->data);
            if ($this->Statuts->save($statut)) {
                $this->Flash->success('Le statut a bien été sauvegardé');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error("Le statut n'a pu être sauvegardé");
            }
        }
        $this->set(compact('statut'));
        $this->set('_serialize', ['statut']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Periode id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $statut = $this->Statuts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->data);
            //die();
            $statut = $this->Statuts->patchEntity($statut, $this->request->data);
            if ($this->Statuts->save($statut)) {
                $this->Flash->success('Le statut a bien été modifié');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error("Le statut n'a pu être modifié");
            }
        }
        $this->set(compact('statut'));
        $this->set('_serialize', ['statut']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Periode id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $statut = $this->Statuts->get($id);
        if ($this->Statuts->delete($statut)) {
            $this->Flash->success('Le statut a bien été supprimé');
        } else {
            $this->Flash->error("Le statut n'a pu être supprimé");
        }
        return $this->redirect(['action' => 'index']);
    }
}
