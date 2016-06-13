<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InstrumentClasses Controller
 *
 * @property \App\Model\Table\InstrumentClassesTable $InstrumentClasses
 */
class InstrumentClassesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $instrumentClasses = $this->paginate($this->InstrumentClasses);

        $this->set(compact('instrumentClasses'));
        $this->set('_serialize', ['instrumentClasses']);
    }

    /**
     * View method
     *
     * @param string|null $id Instrument Class id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
      $query = $this->InstrumentClasses->find()
        ->where(['class'=>$id]);
      $instrumentClass = $query->first();
      
      if (empty($instrumentClass)) {
          throw new NotFoundException(__('Instrument Class not found'));
      }

      $this->set('instrumentClass', $instrumentClass);
      $this->set('_serialize', ['instrumentClass']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function admin_add()
    {
        $instrumentClass = $this->InstrumentClasses->newEntity();
        if ($this->request->is('post')) {
            $instrumentClass = $this->InstrumentClasses->patchEntity($instrumentClass, $this->request->data);
            if ($this->InstrumentClasses->save($instrumentClass)) {
                $this->Flash->success(__('The instrument class has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The instrument class could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('instrumentClass'));
        $this->set('_serialize', ['instrumentClass']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Instrument Class id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function admin_edit($id = null)
    {
        $instrumentClass = $this->InstrumentClasses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $instrumentClass = $this->InstrumentClasses->patchEntity($instrumentClass, $this->request->data);
            if ($this->InstrumentClasses->save($instrumentClass)) {
                $this->Flash->success(__('The instrument class has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The instrument class could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('instrumentClass'));
        $this->set('_serialize', ['instrumentClass']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Instrument Class id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function admin_delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $instrumentClass = $this->InstrumentClasses->get($id);
        if ($this->InstrumentClasses->delete($instrumentClass)) {
            $this->Flash->success(__('The instrument class has been deleted.'));
        } else {
            $this->Flash->error(__('The instrument class could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
