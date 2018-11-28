<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

/**
 * Instruments Controller
 *
 * @property \App\Model\Table\InstrumentsTable $Instruments
 */
class InstrumentsController extends AppController
{

    /**
     * beforeFilter method
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['all','report','status','statsDaily','statsMonthly']);
    }

    /**
     * isAuthorized method
     */
    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['edit','status'])) {
            return true;
        }        
        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($site=null,$status=null) {
      $this->paginate = [
        'contain' => 'Nodes.Sites.Regions'
      ];
      $query = $this->Instruments->find('all');
      if ($site) {
        $query->where(['parent_node LIKE'=>$site.'%']);
      }
      if ($status) {
        $query->where(['Instruments.current_status'=>$status]);
      }
      if ($this->request->is('json') ) { //Formerly ajax
        $this->paginate = [
          'limit' => 2000, 
          'maxLimit' => 2000,
          'contain' => 'Nodes.Sites.Regions'
        ];
        $this->set('_serialize', false);
      }
      $this->set('instruments',$this->paginate($query));
    }
    
    /**
     * All method
     *
     * @return \Cake\Network\Response|null
     */
    public function all($site=null) {
      //Simple view to render DataTables.js
    }

    /**
     * View method
     *
     * @param string|null $id Instrument id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
      $query = $this->Instruments->find()
        ->where(['Instruments.reference_designator'=>$id])
        ->contain(['Nodes.Sites.Regions','DataStreams.Streams.Parameters','Deployments']);
      $instrument = $query->first();
      
      if (empty($instrument)) {
          throw new NotFoundException(__('Instrument not found'));
      }

      $this->loadModel('InstrumentClasses');
      $query = $this->InstrumentClasses->find()
        ->where(['class'=> substr($instrument->reference_designator,18,5)]);
      $instrument_class = $query->first();

      $this->loadModel('InstrumentModels');
      $query = $this->InstrumentModels->find()
        ->where(['class'=> substr($instrument->reference_designator,18,5), 'series'=>substr($instrument->reference_designator,23,1)]);
      $instrument_model = $query->first();

      $notes = $this->Instruments->Notes->find('all')
        ->where(['reference_designator'=> $instrument->reference_designator])
        ->orWhere(['reference_designator'=> $instrument->node->site->reference_designator])
        ->orWhere(['reference_designator'=> $instrument->node->reference_designator])
        ->contain(['Users'])
        ->order(['start_date'=>'ASC']);
      $instrument->notes = $notes;
      
      $annotations = $this->Instruments->Annotations->find('all')
        ->where(['reference_designator'=> $instrument->reference_designator])
        ->orWhere(['reference_designator'=> $instrument->node->site->reference_designator])
        ->orWhere(['reference_designator'=> $instrument->node->reference_designator])
        //->andWhere(['OR'=>['method' => '', 'method IS'=>Null]])
        ->order(['start_datetime'=>'ASC']);
      $instrument->annotations = $annotations;

      $this->set(compact(['instrument','instrument_class','instrument_model']));
      $this->set('_serialize', ['instrument']);
    }
    
    /**
     * Report method
     *
     * @param string|null $id Instrument id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function report($id = null) {
      $query = $this->Instruments->find()
        ->where(['Instruments.reference_designator'=>$id])
        ->contain(['Nodes.Sites.Regions','Reviews','Deployments']);
      $instrument = $query->first();
      
      if (empty($instrument)) {
          throw new NotFoundException(__('Instrument not found'));
      }

      $this->loadModel('InstrumentClasses');
      $query = $this->InstrumentClasses->find()
        ->where(['class'=> substr($instrument->reference_designator,18,5)]);
      $instrument_class = $query->first();

      $this->loadModel('InstrumentModels');
      $query = $this->InstrumentModels->find()
        ->where(['class'=> substr($instrument->reference_designator,18,5), 'series'=>substr($instrument->reference_designator,23,1)]);
      $instrument_model = $query->first();

      $notes = $this->Instruments->Notes->find('all')
        ->where(['reference_designator'=> $instrument->reference_designator])
        ->orWhere(['reference_designator'=> $instrument->node->site->reference_designator])
        ->orWhere(['reference_designator'=> $instrument->node->reference_designator])
        ->contain(['Users'])
        ->order(['start_date'=>'ASC']);
      $instrument->notes = $notes;
      
      $annotations = $this->Instruments->Annotations->find('all')
        ->where(['reference_designator'=> $instrument->reference_designator])
        ->orWhere(['reference_designator'=> $instrument->node->site->reference_designator])
        ->orWhere(['reference_designator'=> $instrument->node->reference_designator])
        //->andWhere(['OR'=>['method' => '', 'method IS'=>Null]])
        ->order(['start_datetime'=>'ASC']);
      $instrument->annotations = $annotations;

      $this->set(compact(['instrument','instrument_class','instrument_model']));
      $this->set('_serialize', ['instrument']);
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Instrument id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $query = $this->Instruments->find()
          ->where(['Instruments.reference_designator'=>$id])
          ->contain(['Nodes.Sites.Regions']);
        $instrument = $query->first();
        
        if (empty($instrument)) {
            throw new NotFoundException(__('Instrument not found'));
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $instrument = $this->Instruments->patchEntity($instrument, $this->request->data, [
                'fieldList'=>['start_depth','end_depth','location','uframe_status','current_status']
            ]);
            if ($this->Instruments->save($instrument)) {
                $this->Flash->success(__('The instrument has been updated.'));
                return $this->redirect(['action' => 'report', $instrument->reference_designator]);
            } else {
                $this->Flash->error(__('The instrument could not be updated. Please, try again.'));
            }
        }
        $this->set(compact('instrument'));
        $this->set('_serialize', ['instrument']);
    }


    /**
     * Status method
     */
    public function status() {
        $query = $this->Instruments->find();
        $query->select(['region'=>'LEFT(reference_designator,2)','current_status','count' => $query->func()->count('*')])
          ->group(['LEFT(reference_designator,2)','current_status']);
        $status = $query->all()->toArray();

        $this->loadModel('ImportLog');
        $import_time = $this->ImportLog->find()
          ->where(['name'=>'status_check'])
          ->first();
        
        $this->set(compact(['status','import_time']));      
        $this->set('_serialize', ['status']);
    }
    
    
    /**
     * Daily Stats method
     *
     * @return \Cake\Network\Response|null
     */
    public function statsDaily($id = null)
    {
      $query = $this->Instruments->find()
        ->where(['Instruments.reference_designator'=>$id])
        ->contain(['Nodes.Sites.Regions']);
      $instrument = $query->first();
      
      if (empty($instrument)) {
          throw new NotFoundException(__('Instrument not found'));
      }
      
      if ($this->request->is('json') ) { 
        $this->loadModel('InstrumentStats');
        $query = $this->InstrumentStats->find('all')
          ->where(['reference_designator'=>$instrument->reference_designator])
          ->select(['date','percentage'=>'status','count'=>'status','sum'=>'status']);
        $data = $query->all()->toArray();
        
        $this->set(compact(['data']));
        $this->set('_serialize', false);
        
      } else {

        $this->loadModel('ImportLog');
        $import_time = $this->ImportLog->findByName('instrument_stats')->first();
        
        $this->set(compact(['instrument','import_time']));
        $this->set('_serialize', ['dataStream']);
      }
    }
    
    
    /**
     * Monthly Stats method
     */
    public function statsMonthly($id = null) {
      $query = $this->Instruments->find()
        ->where(['Instruments.reference_designator'=>$id])
        ->contain(['Nodes.Sites.Regions']);
      $instrument = $query->first();
      
      if (empty($instrument)) {
          throw new NotFoundException(__('Instrument not found'));
      }
      
      if ($this->request->is('json') ) { 
                
        $this->loadModel('StreamStats');
        $query = $this->StreamStats->find('all')
          ->where(['reference_designator'=>$instrument->reference_designator]);
        $ym = $query->func()->date_format([
          'date' => 'identifier',
          "'%Y-%m'" => 'literal'
        ]);
        $query->select(['month' => $ym, 
                        'method', 
                        'stream', 
                        'reference_designator' => $query->func()->concat(['method' => 'identifier',' ','stream' => 'identifier']),
                        'count' => $query->func()->count('status'), 
                        'sum' => $query->func()->sum('status')])
          ->group([$ym, 'method','stream'])
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
        
        $this->set(compact(['instrument','import_time']));
        $this->set('_serialize', ['dataStream']);
      }
    }

}
