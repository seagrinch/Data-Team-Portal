<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Nodes Controller
 *
 * @property \App\Model\Table\NodesTable $Nodes
 */
class NodesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $nodes = $this->paginate($this->Nodes);

        $this->set(compact('nodes'));
        $this->set('_serialize', ['nodes']);
    }

    /**
     * View method
     *
     * @param string|null $id Node id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
      $query = $this->Nodes->find()
        ->where(['Nodes.reference_designator'=>$id])
        ->contain(['Sites.Regions','Instruments']);
      $node = $query->first();
      
      if (empty($node)) {
          throw new NotFoundException(__('Node not found'));
      }

      $this->set('node', $node);
      $this->set('_serialize', ['node']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function admin_add()
    {
        $node = $this->Nodes->newEntity();
        if ($this->request->is('post')) {
            $node = $this->Nodes->patchEntity($node, $this->request->data);
            if ($this->Nodes->save($node)) {
                $this->Flash->success(__('The node has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The node could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('node'));
        $this->set('_serialize', ['node']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Node id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function admin_edit($id = null)
    {
        $node = $this->Nodes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $node = $this->Nodes->patchEntity($node, $this->request->data);
            if ($this->Nodes->save($node)) {
                $this->Flash->success(__('The node has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The node could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('node'));
        $this->set('_serialize', ['node']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Node id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function admin_delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $node = $this->Nodes->get($id);
        if ($this->Nodes->delete($node)) {
            $this->Flash->success(__('The node has been deleted.'));
        } else {
            $this->Flash->error(__('The node could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
