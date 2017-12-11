<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

/**
 * Nodes Controller
 *
 * @property \App\Model\Table\NodesTable $Nodes
 */
class NodesController extends AppController
{

    /**
     * beforeFilter method
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['statsDaily','statsMonthly']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $query = $this->Nodes->find()->contain('Sites');
        $nodes = $this->paginate($query);

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
        ->contain(['Sites.Regions','Instruments','Deployments']);
      $node = $query->first();
      
      if (empty($node)) {
          throw new NotFoundException(__('Node not found'));
      }

      $notes = $this->Nodes->Notes->find('all')
        ->where(['reference_designator'=> $node->reference_designator])
        ->orWhere(['reference_designator'=> $node->site->reference_designator])
        ->contain(['Users'])
        ->order(['start_date'=>'ASC']);
      $node->notes = $notes;
      
      $annotations = $this->Nodes->Annotations->find('all')
        ->where(['reference_designator'=> $node->reference_designator])
        ->order(['start_datetime'=>'ASC']);
      $node->annotations = $annotations;

      $this->set('node', $node);
      $this->set('_serialize', ['node']);
    }


    /**
     * Daily Stats method
     *
     * @return \Cake\Network\Response|null
     */
    public function statsDaily($id = null)
    {
      $query = $this->Nodes->find()
        ->where(['Nodes.reference_designator'=>$id])
        ->contain(['Sites.Regions']);
      $node = $query->first();
      
      if (empty($node)) {
          throw new NotFoundException(__('Node not found'));
      }
      
      if ($this->request->is('json') ) { 
        
        $this->loadModel('InstrumentStats');
        $query = $this->InstrumentStats->find('all')
          ->where(['LEFT(reference_designator,14)'=>$node->reference_designator])
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

        $this->loadModel('ImportLog');
        $import_time = $this->ImportLog->findByName('instrument_stats')->first();
        
        $this->set(compact(['node','import_time']));
        $this->set('_serialize', ['dataStream']);
      }
    }
    
    
    /**
     * Montly Stats method
     */
    public function statsMonthly($id = null) {
      $query = $this->Nodes->find()
        ->where(['Nodes.reference_designator'=>$id])
        ->contain(['Sites.Regions']);
      $node = $query->first();
      
      if (empty($node)) {
          throw new NotFoundException(__('Node not found'));
      }
      
      if ($this->request->is('json') ) { 

        $this->loadModel('InstrumentStats');
        $query = $this->InstrumentStats->find('all');
        $ym = $query->func()->date_format([
          'date' => 'identifier',
          "'%Y-%m'" => 'literal'
        ]);
        $query->where(['LEFT(reference_designator,14)'=>$node->reference_designator])
          ->select(['month' => $ym, 
                    'reference_designator',
                    'count' => $query->func()->count('status'), 
                    'sum' => $query->func()->sum('status')])
          ->group(['reference_designator','month'])
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

        $this->loadModel('ImportLog');
        $import_time = $this->ImportLog->findByName('instrument_stats')->first();
        
        $this->set(compact(['node','import_time']));
        $this->set('_serialize', ['dataStream']);
      }
    }

}
