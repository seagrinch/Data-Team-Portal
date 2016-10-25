<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Streams Controller
 *
 * @property \App\Model\Table\StreamsTable $Streams
 */
class StreamsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $streams = $this->paginate($this->Streams);

        $this->set(compact('streams'));
        $this->set('_serialize', ['streams']);
    }

    /**
     * View method
     *
     * @param string|null $id Stream id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($name = null)
    {
        $query = $this->Streams->find()
          ->where(['Streams.name'=>$name])
          ->contain(['Parameters','DataStreams.Instruments','Notes.Users']);
        $stream = $query->first();

        $this->set('stream', $stream);
        $this->set('_serialize', ['stream']);
    }

}
