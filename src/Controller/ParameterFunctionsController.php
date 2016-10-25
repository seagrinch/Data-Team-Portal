<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * ParameterFunctions Controller
 *
 * @property \App\Model\Table\ParameterFunctionsTable $ParameterFunctions
 */
class ParameterFunctionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $parameterFunctions = $this->paginate($this->ParameterFunctions);

        $this->set(compact('parameterFunctions'));
        $this->set('_serialize', ['parameterFunctions']);
    }

    /**
     * View method
     *
     * @param string|null $id Parameter Function id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $parameterFunction = $this->ParameterFunctions->get($id, [
            'contain' => ['Parameters']
        ]);

        $this->set('parameterFunction', $parameterFunction);
        $this->set('_serialize', ['parameterFunction']);
    }

}
