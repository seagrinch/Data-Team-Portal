<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * InstrumentModels Controller
 *
 * @property \App\Model\Table\InstrumentModelsTable $InstrumentModels
 */
class InstrumentModelsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $instrumentModels = $this->paginate($this->InstrumentModels);

        $this->set(compact('instrumentModels'));
        $this->set('_serialize', ['instrumentModels']);
    }

    /**
     * View method
     *
     * @param string|null $id Instrument Model id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($iclass = null,$iseries = null) {
      $query = $this->InstrumentModels->find()
        ->where(['InstrumentModels.class'=>$iclass,'series'=>$iseries])
        ->contain('InstrumentClasses');
      $instrumentModel = $query->first();
      
      if (empty($instrumentModel)) {
          throw new NotFoundException(__('Instrument Model not found'));
      }

      $this->loadModel('Instruments');
      $instruments = $this->Instruments->find('all')
        ->where(['Instruments.reference_designator LIKE' => '%' . $instrumentModel->class . $instrumentModel->series . '%'])
        ->contain('Nodes.Sites.Regions');

      $this->set(compact(['instrumentModel','instruments']));
      $this->set('_serialize', ['instrumentModel']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function admin_add()
    {
        $instrumentModel = $this->InstrumentModels->newEntity();
        if ($this->request->is('post')) {
            $instrumentModel = $this->InstrumentModels->patchEntity($instrumentModel, $this->request->data);
            if ($this->InstrumentModels->save($instrumentModel)) {
                $this->Flash->success(__('The instrument model has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The instrument model could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('instrumentModel'));
        $this->set('_serialize', ['instrumentModel']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Instrument Model id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function admin_dit($id = null)
    {
        $instrumentModel = $this->InstrumentModels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $instrumentModel = $this->InstrumentModels->patchEntity($instrumentModel, $this->request->data);
            if ($this->InstrumentModels->save($instrumentModel)) {
                $this->Flash->success(__('The instrument model has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The instrument model could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('instrumentModel'));
        $this->set('_serialize', ['instrumentModel']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Instrument Model id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function admin_delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $instrumentModel = $this->InstrumentModels->get($id);
        if ($this->InstrumentModels->delete($instrumentModel)) {
            $this->Flash->success(__('The instrument model has been deleted.'));
        } else {
            $this->Flash->error(__('The instrument model could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
