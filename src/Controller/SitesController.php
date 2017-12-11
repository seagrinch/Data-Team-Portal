<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

/**
 * Sites Controller
 *
 * @property \App\Model\Table\SitesTable $Sites
 */
class SitesController extends AppController
{

    /**
     * beforeFilter method
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['statsDaily','statsMonthly']);
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
    public function index($region=null) {
      $query = $this->Sites->find('all');
      if ($region) {
        $query->where(['parent_region'=>$region]);
      }
      $this->set('sites',$this->paginate($query));
      $this->set('_serialize', 'sites');
    }

    /**
     * View method
     *
     * @param string|null $id Site id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
      $query = $this->Sites->find()
        ->where(['Sites.reference_designator'=>$id])
        ->contain(['Regions','Nodes','Nodes.Instruments','Deployments']);
      $site = $query->first();
      
      if (empty($site)) {
          throw new NotFoundException(__('Site not found'));
      }

      $notes = $this->Sites->Notes->find('all')
        ->where(['reference_designator'=> $site->reference_designator])
        ->contain(['Users'])
        ->order(['start_date'=>'ASC']);
      $site->notes = $notes;

      $annotations = $this->Sites->Annotations->find('all')
        ->where(['reference_designator'=> $site->reference_designator])
        ->order(['start_datetime'=>'ASC']);
      $site->annotations = $annotations;

      $this->set('site', $site);
      $this->set('_serialize', ['site']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Site id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $query = $this->Sites->find()
          ->where(['Sites.reference_designator'=>$id])
          ->contain(['Regions']);
        $site = $query->first();
        
        if (empty($site)) {
            throw new NotFoundException(__('Site not found'));
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $site = $this->Sites->patchEntity($site, $this->request->data, [
                'fieldList'=>['latitude','longitude','bottom_depth','current_status']
            ]);
            if ($this->Sites->save($site)) {
                $this->Flash->success(__('The site has been updated.'));
                return $this->redirect(['action' => 'view', $site->reference_designator]);
            } else {
                $this->Flash->error(__('The site could not be updated. Please, try again.'));
            }
        }
        $this->set(compact('site'));
        $this->set('_serialize', ['site']);
    }
    
    
    /**
     * Daily Stats method
     *
     * @return \Cake\Network\Response|null
     */
    public function statsDaily($id = null)
    {
      $query = $this->Sites->find()
        ->where(['Sites.reference_designator'=>$id])
        ->contain(['Regions']);
      $site = $query->first();
      
      if (empty($site)) {
          throw new NotFoundException(__('Site not found'));
      }
      
      if ($this->request->is('json') ) { 
        
        $this->loadModel('InstrumentStats');
        $query = $this->InstrumentStats->find('all')
          ->where(['LEFT(reference_designator,8)'=>$site->reference_designator])
          ->select(['date', 
                    'count' => $query->func()->count('status'), 
                    'sum' => $query->func()->sum('status')])
          ->group(['date'])
          ->formatResults(function (\Cake\Collection\CollectionInterface $results) {
            return $results->map(function ($row) {
              $row['percentage'] = $row['sum'] / $row['count'];
              return $row;
            });
          });
        $data = $query->all()->toArray();
        
        $this->set(compact(['data']));
        $this->set('_serialize', false);
        
      } else {
        
        $this->loadModel('ImportLog');
        $import_time = $this->ImportLog->findByName('instrument_stats')->first();
        
        $this->set(compact(['site','import_time']));
        $this->set('_serialize', ['dataStream']);
        
      }
    }
    
    
    /**
     * Montly Stats method
     */
    public function statsMonthly($id = null) {
      $query = $this->Sites->find()
        ->where(['Sites.reference_designator'=>$id])
        ->contain(['Regions']);
      $site = $query->first();
      
      if (empty($site)) {
          throw new NotFoundException(__('Site not found'));
      }
      
      if ($this->request->is('json') ) { 

        $this->loadModel('InstrumentStats');
        $query = $this->InstrumentStats->find('all');
        $ym = $query->func()->date_format([
          'date' => 'identifier',
          "'%Y-%m'" => 'literal'
        ]);
        $query->where(['LEFT(reference_designator,8)'=>$site->reference_designator])
          ->select(['month' => $ym, 
                    'reference_designator',
                    'count' => $query->func()->count('status'), 
                    'sum' => $query->func()->sum('status')])
          ->group(['month','reference_designator'])
          ->formatResults(function (\Cake\Collection\CollectionInterface $results) {
            return $results->map(function ($row) {
              $row['percentage'] = $row['sum'] / $row['count'];
              return $row;
            });
          });
        $data = $query->all()->toArray();
        
        $this->set(compact(['data']));
        $this->set('_serialize', false);
                
      } else {

        $this->loadModel('ImportLog');
        $import_time = $this->ImportLog->findByName('instrument_stats')->first();
        
        $this->set(compact(['site','import_time']));
        $this->set('_serialize', ['dataStream']);
        
      }
    }

}
