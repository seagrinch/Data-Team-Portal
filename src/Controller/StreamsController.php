<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

/**
 * Streams Controller
 *
 * @property \App\Model\Table\StreamsTable $Streams
 */
class StreamsController extends AppController
{

    /**
     * beforeFilter method
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['all']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
      $query = $this->Streams->find('all');
      if ($this->request->is('json') ) { //Formerly ajax
        $this->paginate['limit'] = 1000;
        $query->contain();
        $this->set('_serialize', false);
      }
      $this->set('streams',$this->paginate($query));
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
     * @param string|null $id Stream id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($name = null)
    {
        $query = $this->Streams->find()
          ->where(['Streams.name'=>$name])
          ->contain(['Parameters','DataStreams.Instruments']);
        $stream = $query->first();

        $this->set('stream', $stream);
        $this->set('_serialize', ['stream']);
    }

}
