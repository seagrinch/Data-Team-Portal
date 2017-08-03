<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

/**
 * Assets Controller
 *
 * @property \App\Model\Table\AssetsTable $Assets
 */
class AssetsController extends AppController
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
    public function index() {
      $query = $this->Assets->find('all');
      if ($this->request->is('json') ) { //Formerly ajax
        $this->paginate = [
          'limit' => 5000, 
          'maxLimit' => 5000,
        ];
        $this->set('_serialize', false);
      }
      $this->set('assets',$this->paginate($query));
    }

    /**
     * All method
     *
     * @return \Cake\Network\Response|null
     */
    public function all() {
      //Simple view to render DataTables.js
    }

    /**
     * View method
     *
     * @param string|null $id Asset id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
      $query = $this->Assets->find()
        ->where(['asset_uid'=>$id])
        ->contain(['Calibrations','SensorDeployments']);
      $asset = $query->first();
      
      if (empty($asset)) {
          throw new NotFoundException(__('Asset not found'));
      }

      $notes = $this->Assets->Notes->find('all')
        ->where(['asset_uid'=> $asset->asset_uid])
        ->contain(['Users'])
        ->order(['start_date'=>'ASC']);
      $asset->notes = $notes;

      $this->set('asset', $asset);
      $this->set('_serialize', ['asset']);
    }

}
