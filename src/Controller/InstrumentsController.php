<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

/**
 * Instruments Controller
 *
 * @property \App\Model\Table\InstrumentsTable $Instruments
 */
class InstrumentsController extends AppController
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
     * isAuthorized method
     */
    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['edit'])) {
            return true;
        }        
        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($site=null) {
      $query = $this->Instruments->find('all');
      if ($site) {
        $query->where(['parent_node LIKE'=>$site.'%']);
      }
      if ($this->request->is('json') ) { //Formerly ajax
        $this->paginate['limit'] = 2000;
        $query->contain(['Nodes.Sites.Regions']);
        $this->set('_serialize', false);
      }
      $this->set('instruments',$this->paginate($query));
    }
    
    /**
     * All method
     *
     * @return \Cake\Network\Response|null
     */
    public function all($site=null) {
    }

    /**
     * View method
     *
     * @param string|null $id Instrument id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
      $query = $this->Instruments->find()
        ->where(['Instruments.reference_designator'=>$id])
        ->contain(['Nodes.Sites.Regions','Deployments',
          'DataStreams.Streams.Parameters','Notes.Users','MonthlyStats','TestRuns']);
      $instrument = $query->first();
      
      if (empty($instrument)) {
          throw new NotFoundException(__('Instrument not found'));
      }

      $this->loadModel('InstrumentClasses');
      $query = $this->InstrumentClasses->find()
        ->where(['class'=> substr($instrument->reference_designator,18,5)]);
      $instrument_class = $query->first();

      $this->loadModel('InstrumentModels');
      $query = $this->InstrumentModels->find()
        ->where(['class'=> substr($instrument->reference_designator,18,5), 'series'=>substr($instrument->reference_designator,23,1)]);
      $instrument_model = $query->first();

      $this->set(compact(['instrument','instrument_class','instrument_model']));
      $this->set('_serialize', ['instrument']);
    }
    

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function admin_add()
    {
        $instrument = $this->Instruments->newEntity();
        if ($this->request->is('post')) {
            $instrument = $this->Instruments->patchEntity($instrument, $this->request->data);
            if ($this->Instruments->save($instrument)) {
                $this->Flash->success(__('The instrument has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The instrument could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('instrument'));
        $this->set('_serialize', ['instrument']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Instrument id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $query = $this->Instruments->find()
          ->where(['Instruments.reference_designator'=>$id])
          ->contain(['Nodes.Sites.Regions']);
        $instrument = $query->first();
        
        if (empty($instrument)) {
            throw new NotFoundException(__('Instrument not found'));
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $instrument = $this->Instruments->patchEntity($instrument, $this->request->data, [
                'fieldList'=>['start_depth','end_depth','location','uframe_status','current_status']
            ]);
            if ($this->Instruments->save($instrument)) {
                $this->Flash->success(__('The instrument has been updated.'));
                return $this->redirect(['action' => 'view', $instrument->reference_designator]);
            } else {
                $this->Flash->error(__('The instrument could not be updated. Please, try again.'));
            }
        }
        $this->set(compact('instrument'));
        $this->set('_serialize', ['instrument']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Instrument id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function admin_delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $instrument = $this->Instruments->get($id);
        if ($this->Instruments->delete($instrument)) {
            $this->Flash->success(__('The instrument has been deleted.'));
        } else {
            $this->Flash->error(__('The instrument could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
