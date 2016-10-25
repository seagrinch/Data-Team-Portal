<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

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
        ->where(['class'=>$id])
        ->contain(['InstrumentModels']);
      $instrumentClass = $query->first();
      
      if (empty($instrumentClass)) {
          throw new NotFoundException(__('Instrument Class not found'));
      }

      $this->set('instrumentClass', $instrumentClass);
      $this->set('_serialize', ['instrumentClass']);
    }

}
