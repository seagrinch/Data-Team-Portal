<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Regions Controller
 *
 * @property \App\Model\Table\RegionsTable $Regions
 */
class RegionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
      $regions = $this->paginate($this->Regions);

      $this->set(compact('regions'));
      $this->set('_serialize', ['regions']);
    }

    /**
     * View method
     *
     * @param string|null $id Region id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
      $query = $this->Regions->find()
        ->where(['reference_designator'=>$id])
        ->contain(['Sites']);
      $region = $query->first();
      
      if (empty($region)) {
          throw new NotFoundException(__('Array not found'));
      }

      $this->set('region', $region);
      $this->set('_serialize', ['region']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function admin_add()
    {
        $region = $this->Regions->newEntity();
        if ($this->request->is('post')) {
            $region = $this->Regions->patchEntity($region, $this->request->data);
            if ($this->Regions->save($region)) {
                $this->Flash->success(__('The region has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The region could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('region'));
        $this->set('_serialize', ['region']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Region id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function admin_edit($id = null)
    {
        $region = $this->Regions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $region = $this->Regions->patchEntity($region, $this->request->data);
            if ($this->Regions->save($region)) {
                $this->Flash->success(__('The region has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The region could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('region'));
        $this->set('_serialize', ['region']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Region id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function admin_delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $region = $this->Regions->get($id);
        if ($this->Regions->delete($region)) {
            $this->Flash->success(__('The region has been deleted.'));
        } else {
            $this->Flash->error(__('The region could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
