<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

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

}
