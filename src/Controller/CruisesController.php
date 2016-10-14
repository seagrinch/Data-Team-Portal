<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cruises Controller
 *
 * @property \App\Model\Table\CruisesTable $Cruises
 */
class CruisesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $cruises = $this->paginate($this->Cruises);

        $this->set(compact('cruises'));
        $this->set('_serialize', ['cruises']);
    }

    /**
     * View method
     *
     * @param string|null $id Cruise id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($cuid = null)
    {
        $query = $this->Cruises->find()
          ->where(['Cruises.cuid'=>$cuid])
          ->contain([]);
        $cruise = $query->first();

        $this->set('cruise', $cruise);
        $this->set('_serialize', ['cruise']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function admin_add()
    {
        $cruise = $this->Cruises->newEntity();
        if ($this->request->is('post')) {
            $cruise = $this->Cruises->patchEntity($cruise, $this->request->data);
            if ($this->Cruises->save($cruise)) {
                $this->Flash->success(__('The cruise has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cruise could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cruise'));
        $this->set('_serialize', ['cruise']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cruise id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function admin_edit($id = null)
    {
        $cruise = $this->Cruises->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cruise = $this->Cruises->patchEntity($cruise, $this->request->data);
            if ($this->Cruises->save($cruise)) {
                $this->Flash->success(__('The cruise has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cruise could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cruise'));
        $this->set('_serialize', ['cruise']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cruise id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function admin_delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cruise = $this->Cruises->get($id);
        if ($this->Cruises->delete($cruise)) {
            $this->Flash->success(__('The cruise has been deleted.'));
        } else {
            $this->Flash->error(__('The cruise could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
