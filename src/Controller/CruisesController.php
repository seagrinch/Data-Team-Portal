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
        $this->paginate = [
          'limit' => 25,
          'order' => ['cruise_start_date' => 'desc'],
          'contain' => ['CruiseReviews'],
          'sortWhitelist' => [
            'cuid', 'ship_name', 'notes', 'cruise_start_date', 'cruise_end_date', 
            'CruiseReviews.status', 'CruiseReviews.modified'
          ]
        ];
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
          ->contain([
            'Deployments'=>['sort'=>['start_date','reference_designator']],
            'CruiseReviews.Users']);
        $cruise = $query->first();

        if (empty($cruise)) {
          $this->Flash->error('Cruise ' . $cuid . ' could not be found.');
          return $this->redirect(['action' => 'index']);
        }

        $this->set('cruise', $cruise);
        $this->set('_serialize', ['cruise']);
    }

}
