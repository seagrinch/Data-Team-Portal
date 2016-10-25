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
          ->contain(['Deployments']);
        $cruise = $query->first();

        $this->set('cruise', $cruise);
        $this->set('_serialize', ['cruise']);
    }

}
