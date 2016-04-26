<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Periodes Controller
 *
 * @property \App\Model\Table\PeriodesTable $Periodes
 */
class PeriodesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('periodes', $this->Periodes->find('all'));
        $this->set('_serialize', ['periodes']);
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
        $periode = $this->Periodes->get($id, [
            'contain' => ['Groupes.Modules']
        ]);
        $this->set('periode', $periode);
        $this->set('_serialize', ['periode']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $periode = $this->Periodes->newEntity();
        if ($this->request->is('post')) {
            $periode = $this->Periodes->patchEntity($periode, $this->request->data);
            if ($this->Periodes->save($periode)) {
                $this->Flash->success('La période a bien été sauvegardée');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error("La période n'a pu être sauvegardée");
            }
        }
        $this->set(compact('periode'));
        $this->set('_serialize', ['periode']);
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
        $periode = $this->Periodes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->data);
            //die();
            $periode = $this->Periodes->patchEntity($periode, $this->request->data);
            if ($this->Periodes->save($periode)) {
                $this->Flash->success('La période a bien été modifiée');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error("La période n'a pu être modifiée");
            }
        }
        $this->set(compact('periode'));
        $this->set('_serialize', ['periode']);
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
        $periode = $this->Periodes->get($id);
        if ($this->Periodes->delete($periode)) {
            $this->Flash->success('La période a bien été supprimée');
        } else {
            $this->Flash->error("La période n'a pu être supprimée");
        }
        return $this->redirect(['action' => 'index']);
    }
}
