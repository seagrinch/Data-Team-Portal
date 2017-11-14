<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

/**
 * DataStreams Controller
 *
 * @property \App\Model\Table\DataStreamsTable $DataStreams
 */
class DataStreamsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
    }
    
    /**
     * beforeFilter method
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['plot','plotData','statsDaily']);
    }


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Instruments', 'Streams']
        ];
        $dataStreams = $this->paginate($this->DataStreams);

        $this->set(compact('dataStreams'));
        $this->set('_serialize', ['dataStreams']);
    }

    /**
     * View method
     *
     * @param string|null $id Data Stream id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
      $dataStream = $this->DataStreams->get($id, [
        'contain' => ['Instruments.Deployments', 'Streams.Parameters']
      ]);

      $annotations = $this->DataStreams->Instruments->Annotations->find('all')
        ->where(['reference_designator'=> $dataStream->reference_designator])
        ->andWhere(['method'=>$dataStream->method])
        ->andWhere(['stream'=>$dataStream->stream_name])
        ->andWhere(['parameter IS'=>Null])
        ->order(['start_datetime'=>'ASC']);
      $dataStream->annotations = $annotations;

      $this->loadComponent('Uframe');
      $cassandra = $this->Uframe->cassandra_times($dataStream->reference_designator, $dataStream->method, $dataStream->stream_name);

      $dataStream->cassandra = $cassandra;

      $this->set('dataStream', $dataStream);
      $this->set('_serialize', ['dataStream']);
    }
    
    
    /**
     * Plot method
     *
     * @return \Cake\Network\Response|null
     */
    public function plot($id = null)
    {
      $dataStream = $this->DataStreams->get($id);
      
      if (empty($dataStream)) {
          throw new NotFoundException(__('Data Stream not found'));
      }
      
      $this->set(compact(['dataStream']));
      $this->set('_serialize', ['dataStream']);
    }
    
    
    /**
     * Plot Data method
     */
    public function plotData($id = null) {
      $dataStream = $this->DataStreams->get($id);
      
      if (empty($dataStream)) {
          throw new NotFoundException(__('Data Stream not found'));
      }
      
      $this->loadComponent('Uframe');
      $data = $this->Uframe->recent_data($dataStream->reference_designator, $dataStream->method, $dataStream->stream_name);
      
      $this->set(compact(['data']));
      $this->set('_serialize', false);
      
    }
    
    
    /**
     * Stats Data method
     */
    public function statsDaily($id = null) {
      $dataStream = $this->DataStreams->get($id);
      
      if (empty($dataStream)) {
          throw new NotFoundException(__('Data Stream not found'));
      }
      
      if ($this->request->is('json') ) { 
        $this->loadModel('StreamStats');
        $query = $this->StreamStats->find('all')
          ->where(['reference_designator'=>$dataStream->reference_designator, 'method'=>$dataStream->method, 'stream'=>$dataStream->stream_name])
          ->select(['date','percentage'=>'status']);
        $data = $query->all()->toArray();
        
        $this->set(compact(['data']));
        $this->set('_serialize', false);
      } else {
        $this->set(compact(['dataStream']));
        $this->set('_serialize', ['dataStream']);
      }
    }

}
