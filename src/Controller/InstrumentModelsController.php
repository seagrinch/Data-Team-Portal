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

}
