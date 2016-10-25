<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Nodes Controller
 *
 * @property \App\Model\Table\NodesTable $Nodes
 */
class NodesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $query = $this->Nodes->find()->contain('Sites');
        $nodes = $this->paginate($query);

        $this->set(compact('nodes'));
        $this->set('_serialize', ['nodes']);
    }

    /**
     * View method
     *
     * @param string|null $id Node id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
      $query = $this->Nodes->find()
        ->where(['Nodes.reference_designator'=>$id])
        ->contain(['Sites.Regions','Instruments','Notes.Users','Deployments']);
      $node = $query->first();
      
      if (empty($node)) {
          throw new NotFoundException(__('Node not found'));
      }

      $this->set('node', $node);
      $this->set('_serialize', ['node']);
    }

}
