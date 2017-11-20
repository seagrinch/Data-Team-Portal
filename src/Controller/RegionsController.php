<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

/**
 * Regions Controller
 *
 * @property \App\Model\Table\RegionsTable $Regions
 */
class RegionsController extends AppController
{

    /**
     * beforeFilter method
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['statsDaily','statsMonthly','arrayDaily','arrayMonthly']);
    }

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
     * Daily Stats method
     *
     * @return \Cake\Network\Response|null
     */
    public function statsDaily($id = null)
    {
      $query = $this->Regions->find()
        ->where(['reference_designator'=>$id])
        ->contain(['Sites']);
      $region = $query->first();
      
      if (empty($region)) {
          throw new NotFoundException(__('Array not found'));
      }
      
      if ($this->request->is('json') ) { 
        $this->loadModel('InstrumentStats');
        $query = $this->InstrumentStats->find('all')
          ->where(['LEFT(reference_designator,2)'=>$region->reference_designator])
          ->select(['date', 
                    'count' => $query->func()->count('status'), 
                    'sum' => $query->func()->sum('status')])
          ->group(['date'])
          ->formatResults(function (\Cake\Collection\CollectionInterface $results) {
            return $results->map(function ($row) {
              $row['percentage'] = $row['sum'] / $row['count'];
              return $row;
            });
          });
        $data = $query->all()->toArray();
        
        $this->set(compact(['data']));
        $this->set('_serialize', false);
        
      } else {
        
        $this->set(compact(['region']));
        $this->set('_serialize', ['dataStream']);
      }
    }
    
    
    /**
     * Monthly Stats method
     */
    public function statsMonthly($id = null) 
    {
      $query = $this->Regions->find()
        ->where(['reference_designator'=>$id])
        ->contain(['Sites']);
      $region = $query->first();
      
      if (empty($region)) {
          throw new NotFoundException(__('Array not found'));
      }
      
      if ($this->request->is('json') ) { 
        
        $this->loadModel('InstrumentStats');
        $query = $this->InstrumentStats->find('all');
        $ym = $query->func()->date_format([
          'date' => 'identifier',
          "'%Y-%m'" => 'literal'
        ]);
        $rd = $query->func()->left([
          'reference_designator' => 'identifier',
          "8" => 'literal'
        ]);
        $query->where(['LEFT(reference_designator,2)'=>$region->reference_designator])
          ->select(['month' => $ym, 
                    'rd' => $rd,
                    'count' => $query->func()->count('status'), 
                    'sum' => $query->func()->sum('status')])
          ->group(['month','rd'])
          ->formatResults(function (\Cake\Collection\CollectionInterface $results) {
            return $results->map(function ($row) {
              $row['percentage'] = $row['sum'] / $row['count'];
              return $row;
            });
          });
        $data = $query->all()->toArray();
        
        $this->set(compact(['data']));
        $this->set('_serialize', false);
        
      } else {
        
        $this->set(compact(['region']));
        $this->set('_serialize', ['dataStream']);
      }
    }


    /**
     * Array Daily Stats method
     *
     * @return \Cake\Network\Response|null
     */
    public function arrayDaily()
    {
//       if ($this->request->is('json') ) { 
        $this->loadModel('InstrumentStats');
        $query = $this->InstrumentStats->find('all');
        $query->select(['date', 
                    'count' => $query->func()->count('status'), 
                    'sum' => $query->func()->sum('status')])
          ->group(['date'])
          ->formatResults(function (\Cake\Collection\CollectionInterface $results) {
            return $results->map(function ($row) {
              $row['percentage'] = $row['sum'] / $row['count'];
              return $row;
            });
          });
        $data = $query->all()->toArray();
        
        $this->set(compact(['data']));
        $this->set('_serialize', false);
        
//       }
    }


    /**
     * Array Monthly Stats method
     */
    public function arrayMonthly() {
      if ($this->request->is('json') ) { 
        
        $this->loadModel('InstrumentStats');
        $query = $this->InstrumentStats->find('all');
        $ym = $query->func()->date_format([
          'date' => 'identifier',
          "'%Y-%m'" => 'literal'
        ]);
        $rd = $query->func()->left([
          'reference_designator' => 'identifier',
          "2" => 'literal'
        ]);
        $query->select(['month' => $ym, 
                    'rd' => $rd,
                    'count' => $query->func()->count('status'), 
                    'sum' => $query->func()->sum('status')])
          ->group(['month','rd'])
          ->formatResults(function (\Cake\Collection\CollectionInterface $results) {
            return $results->map(function ($row) {
              $row['percentage'] = $row['sum'] / $row['count'];
              return $row;
            });
          });
        $data = $query->all()->toArray();
        
        $this->set(compact(['data']));
        $this->set('_serialize', false);
        
       }
    }
    
}
