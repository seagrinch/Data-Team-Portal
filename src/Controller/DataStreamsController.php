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
            'contain' => ['Instruments', 'Streams']
        ]);

        $this->set('dataStream', $dataStream);
        $this->set('_serialize', ['dataStream']);
    }


}
