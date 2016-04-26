<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Specialites Controller
 *
 * @property \App\Model\Table\SpecialitesTable $Specialites
 */
class SpecialitesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('title', 'Liste des spécialités');

        $this->paginate = [
            'contain' => ['Mentions']
        ];
        $this->set('specialites', $this->paginate($this->Specialites));
        $this->set('_serialize', ['specialites']);
    }

    /**
     * View method
     *
     * @param string|null $id Specialite id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->set('title', 'voir une spécialité');

        $specialite = $this->Specialites->get($id, [
            'contain' => ['Mentions', 'Parcours']
        ]);
        $this->set('specialite', $specialite);
        $this->set('_serialize', ['specialite']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->set('title', 'Ajouter une spécialité');

        $specialite = $this->Specialites->newEntity();
        if ($this->request->is('post')) {
            $specialite = $this->Specialites->patchEntity($specialite, $this->request->data);
            if ($this->Specialites->save($specialite)) {
                $this->Flash->success('La spécialité a été sauvegardée.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Impossible de sauvegarder la spécialité');
            }
        }
        $mentions = $this->Specialites->Mentions->find('list', ['limit' => 200]);
        $parcours = $this->Specialites->Parcours->find('list', ['limit' => 200]);
        $this->set(compact('specialite', 'mentions', 'parcours'));
        $this->set('_serialize', ['specialite']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Specialite id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->set('title', 'Modifier une spécialité');

        $specialite = $this->Specialites->get($id, [
            'contain' => ['Parcours']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $specialite = $this->Specialites->patchEntity($specialite, $this->request->data);
            if ($this->Specialites->save($specialite)) {
                $this->Flash->success("La spécialité a bien été modifiée");
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Impossible de modifier la spécialité');
            }
        }
        $mentions = $this->Specialites->Mentions->find('list', ['limit' => 200]);
        $parcours = $this->Specialites->Parcours->find('list', ['limit' => 200]);
        $this->set(compact('specialite', 'mentions', 'parcours'));
        $this->set('_serialize', ['specialite']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Specialite id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $specialite = $this->Specialites->get($id);
        if ($this->Specialites->delete($specialite)) {
            $this->Flash->success('La spécialité a bien été supprimée');
        } else {
            $this->Flash->error('Impossible de supprimer la spécialité');
        }
        return $this->redirect(['action' => 'index']);
    }
}
