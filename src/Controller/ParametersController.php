<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

/**
 * Parameters Controller
 *
 * @property \App\Model\Table\ParametersTable $Parameters
 */
class ParametersController extends AppController
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
      $query = $this->Parameters->find('all');
      if ($this->request->is('json') ) { //Formerly ajax
        $this->paginate['limit'] = 5000;
        $query->contain();
        $this->set('_serialize', false);
      }
      $this->set('parameters',$this->paginate($query));
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
     * @param string|null $id Parameter id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $parameter = $this->Parameters->get($id, [
          'contain' => ['ParameterFunctions', 'Streams', 'Notes.Users']
        ]);

        $this->set('parameter', $parameter);
        $this->set('_serialize', ['parameter']);
    }

}
