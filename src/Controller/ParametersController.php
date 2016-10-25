<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Parameters Controller
 *
 * @property \App\Model\Table\ParametersTable $Parameters
 */
class ParametersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => []
        ];
        $parameters = $this->paginate($this->Parameters);

        $this->set(compact('parameters'));
        $this->set('_serialize', ['parameters']);
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
