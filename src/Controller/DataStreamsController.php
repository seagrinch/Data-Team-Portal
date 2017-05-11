<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

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
        $this->loadComponent('Uframe');
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

      $cassandra = $this->Uframe->cassandra_times(
        substr($dataStream->reference_designator,0,8),
        substr($dataStream->reference_designator,9,5),
        substr($dataStream->reference_designator,15,12),
        $dataStream->method,
        $dataStream->stream_name);

      $dataStream->cassandra = $cassandra;

      $this->set('dataStream', $dataStream);
      $this->set('_serialize', ['dataStream']);
    }


}
