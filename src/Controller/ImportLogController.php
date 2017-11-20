<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ImportLog Controller
 *
 * @property \App\Model\Table\ImportLogTable $ImportLog
 */
class ImportLogController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
          'order'=>['name'],
          'limit'=>100
        ];
        $importLog = $this->paginate($this->ImportLog);

        $this->set(compact('importLog'));
        $this->set('_serialize', ['importLog']);
    }

 }
