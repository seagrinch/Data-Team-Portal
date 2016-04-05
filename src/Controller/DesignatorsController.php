<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Designators Controller
 *
 * @property \App\Model\Table\DesignatorsTable $Designators
 */
class DesignatorsController extends AppController {

  /**
   * Index method
   *
   * @return \Cake\Network\Response|null
   */
  public function index() {
    $designators = $this->Designators->find('all')->where(['designator_type' => 'site']);
    //$designators = $this->paginate($query);
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
  public function view($id = null) {
    $query = $this->Designators->find()
      ->where(['Designators.reference_designator'=>$id])
      ->contain(['Parent', 'Child', 'Streams'=>['Parameters']]);
    $designator = $query->first();
    
    if ($designator['designator_type']=='node') {
      $query = $this->Designators->find()
        ->where(['Designators.reference_designator'=>$designator->parent->parent_designator]);
      $site = $query->first();
      $this->set('site',$site);
      
    } else if ($designator['designator_type']=='instrument') {
      $query = $this->Designators->find()
        ->where(['Designators.reference_designator'=>$designator->parent->parent_designator])
        ->contain(['Parent']);
      $platform = $query->first();

      $this->loadModel('InstrumentClasses');
      $query = $this->InstrumentClasses->find()
        ->where(['class'=> substr($designator->reference_designator,18,5)]);
      $instrument_class = $query->first();

      $this->loadModel('InstrumentModels');
      $query = $this->InstrumentModels->find()
        ->where(['class'=> substr($designator->reference_designator,18,5), 'series'=>substr($designator->reference_designator,23,1)]);
      $instrument_model = $query->first();

      $this->loadModel('Deployments');
      $deployments = $this->Deployments->find('all')
        ->where(['reference_designator'=> $designator->reference_designator]);

      $this->set(compact(['platform','instrument_class','instrument_model','deployments']));
      
    }

    $this->set('designator', $designator);
    $this->set('_serialize', ['designator']);
    $this->render('view_'. $designator['designator_type']);
  }

  /**
   * Add method
   *
   * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
   */
  public function admin_add() {
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
  public function admin_edit($id = null) {
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
  public function admin_delete($id = null) {
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
