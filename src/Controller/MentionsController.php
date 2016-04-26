<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Mentions Controller
 *
 * @property \App\Model\Table\MentionsTable $Mentions
 */
class MentionsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('title', 'Liste des mentions');

        $this->set('mentions', $this->paginate($this->Mentions));
        $this->set('_serialize', ['mentions']);
    }

    /**
     * View method
     *
     * @param string|null $id Mention id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->set('title', 'Voir une mentions');

        $mention = $this->Mentions->get($id, [
            'contain' => ['Specialites']
        ]);
        $this->set(compact('mention'));
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->set('title', 'ajouter une mentions');

        $mention = $this->Mentions->newEntity();
        if ($this->request->is('post')) {
            $mention = $this->Mentions->patchEntity($mention, $this->request->data);
            if ($this->Mentions->save($mention)) {
                $this->Flash->success('La mention a bien été sauvegardée');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('La mention ne peut être sauvegardée');
            }
        }
        $this->set(compact('mention'));
        $this->set('_serialize', ['mention']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Mention id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->set('title', 'Modifier une mentions');
        $mention = $this->Mentions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mention = $this->Mentions->patchEntity($mention, $this->request->data);
            if ($this->Mentions->save($mention)) {
                $this->Flash->success('La mention a bien été modifiée');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('La mention ne peut être modifiée');
            }
        }
        $this->set(compact('mention'));
        $this->set('_serialize', ['mention']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Mention id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mention = $this->Mentions->get($id);
        if ($this->Mentions->delete($mention)) {
            $this->Flash->success('La mention a bien été supprimée.');
        } else {
            $this->Flash->error('Impossible de supprimer la mention.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
