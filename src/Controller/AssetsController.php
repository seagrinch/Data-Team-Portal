<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Assets Controller
 *
 * @property \App\Model\Table\AssetsTable $Assets
 */
class AssetsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $assets = $this->paginate($this->Assets);

        $this->set(compact('assets'));
        $this->set('_serialize', ['assets']);
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
        ->contain([]);
      $asset = $query->first();
      
      if (empty($asset)) {
          throw new NotFoundException(__('Asset not found'));
      }

      $this->set('asset', $asset);
      $this->set('_serialize', ['asset']);
    }

}
