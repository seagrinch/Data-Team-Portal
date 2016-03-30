<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Designators Controller
 *
 * @property \App\Model\Table\DesignatorsTable $Designators
 */
class DesignatorsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $designators = $this->paginate($this->Designators);

        $this->set(compact('designators'));
        $this->set('_serialize', ['designators']);
    }

    /**
     * View method
     *
     * @param string|null $id Designator id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $designator = $this->Designators->get($id, [
            'contain' => []
        ]);

        $this->set('designator', $designator);
        $this->set('_serialize', ['designator']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $designator = $this->Designators->newEntity();
        if ($this->request->is('post')) {
            $designator = $this->Designators->patchEntity($designator, $this->request->data);
            if ($this->Designators->save($designator)) {
                $this->Flash->success(__('The designator has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The designator could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('designator'));
        $this->set('_serialize', ['designator']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Designator id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $designator = $this->Designators->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $designator = $this->Designators->patchEntity($designator, $this->request->data);
            if ($this->Designators->save($designator)) {
                $this->Flash->success(__('The designator has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The designator could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('designator'));
        $this->set('_serialize', ['designator']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Designator id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $designator = $this->Designators->get($id);
        if ($this->Designators->delete($designator)) {
            $this->Flash->success(__('The designator has been deleted.'));
        } else {
            $this->Flash->error(__('The designator could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
