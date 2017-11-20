<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ingestions Controller
 *
 * @property \App\Model\Table\IngestionsTable $ImportLog
 */
class IngestionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
    	if ($this->request->query('region')) {
        $this->paginate['conditions']['LEFT(reference_designator,2)'] = $this->request->query('region');
        $this->request->data['region'] = $this->request->query('region');
    	}
    	if ($this->request->query('status')) {
        $this->paginate['conditions']['status'] = $this->request->query('status');
        $this->request->data['status'] = $this->request->query('status');
    	}
    	
      $ingestions = $this->paginate($this->Ingestions);

      $this->set(compact('ingestions'));
      $this->set('_serialize', ['ingestions']);
    }

 }
