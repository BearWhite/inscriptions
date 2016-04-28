<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Employeurs Controller
 *
 * @property \App\Model\Table\EmployeursTable $Employeurs
 */
class EmployeursController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('employeurs', $this->paginate($this->Employeurs));
        $this->set('_serialize', ['employeurs']);
    }

    /**
     * View method
     *
     * @param string|null $id Employeur id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employeur = $this->Employeurs->get($id, [
            'contain' => ['Utilisateurs']
        ]);
        $this->set('employeur', $employeur);
        $this->set('_serialize', ['employeur']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $employeur = $this->Employeurs->newEntity();
        if ($this->request->is('post')) {
            $employeur = $this->Employeurs->patchEntity($employeur, $this->request->data);
            if ($this->Employeurs->save($employeur)) {
                $this->Flash->success(__('The employeur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The employeur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('employeur'));
        $this->set('_serialize', ['employeur']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Employeur id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employeur = $this->Employeurs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employeur = $this->Employeurs->patchEntity($employeur, $this->request->data);
            if ($this->Employeurs->save($employeur)) {
                $this->Flash->success(__('The employeur has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The employeur could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('employeur'));
        $this->set('_serialize', ['employeur']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Employeur id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employeur = $this->Employeurs->get($id);
        if ($this->Employeurs->delete($employeur)) {
            $this->Flash->success(__('The employeur has been deleted.'));
        } else {
            $this->Flash->error(__('The employeur could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
