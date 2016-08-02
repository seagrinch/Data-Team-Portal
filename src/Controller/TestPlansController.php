<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * TestPlans Controller
 *
 * @property \App\Model\Table\TestPlansTable $TestPlans
 */
class TestPlansController extends AppController
{

    /**
     * isAuthorized method
     */
    public function isAuthorized($user)
    {
        // All registered users can add
        if (in_array($this->request->action, ['add'])) {
            return true;
        }
        // Only the owner of an item can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete','addTestItems'])) {
            $id = (int)$this->request->params['pass'][0];
            if ($this->TestPlans->isOwnedBy($id, $user['id'])) {
                return true;
            }
        }
        // Admin can do anything
        if ($user['role'] === 'admin') {
          return true;
        }
        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'], 
            //'where'=> ['user_id'=>$this->Auth->user('id')]
        ];
        $testPlans = $this->paginate($this->TestPlans);

        $this->set(compact('testPlans'));
        $this->set('_serialize', ['testPlans']);
    }

    /**
     * View method
     *
     * @param string|null $id Test Plan id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $testPlan = $this->TestPlans->get($id, [
            'contain' => ['Users']
        ]);

        $this->loadModel('TestItems');
        $this->paginate = [
         'TestItems'=> [
          'contain' => ['TestPlans','TestQuestions','Streams','Parameters'],
          'sortWhitelist' => ['reference_designator', 'method', 'Streams.name','Parameters.name','TestQuestions.question','result']
         ]
        ];
        $query = $this->TestItems->find('all')
          ->where(['test_plan_id'=>$id]);
        $testItems = $this->paginate($query, ['scope'=>'test-item']);
//         $testItems = $this->paginate($query);

        $this->loadModel('Regions');
        $regions = $this->Regions->find('list', ['keyField' => 'reference_designator']);

        $this->set(compact('testPlan','testItems','regions'));
        $this->set('_serialize', ['testPlan']);
    }


    /**
     * Add Test Items method
     *
     * @param string|null $id Test Plan id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function addTestItems()
    {
        if ($this->request->is('post')) {
          $this->loadModel('Instruments');
          $this->loadModel('TestQuestions');

          $testPlan = $this->TestPlans->get($this->request->data['test_plan_id']);

          if ($this->request->data['instrument']=='all') {
            $query = $this->Instruments->find()
              ->where(['Sites.reference_designator'=>$this->request->data['site']])
              ->contain(['DataStreams.Streams.Parameters', 'Nodes.Sites']);
            $instruments = $query->find('all');
          } else {
            $query = $this->Instruments->find()
              ->where(['Instruments.reference_designator'=>$this->request->data['instrument']])
              ->contain(['DataStreams.Streams.Parameters']);
            $instruments = $query->find('all');            
          }
          
          $items = [];
          foreach($instruments as $instrument) {

//           if (!empty($instrument)) {
            
            // Instrument Questions
            if ($this->request->data['instrument_questions']) {
              $questions = $this->TestQuestions->find('all')->where(['type'=>'instrument']);
              foreach ($questions as $q) {
                $testItem = $this->TestPlans->TestItems->newEntity();
                $testItem->test_question_id = $q->id;
                $testItem->reference_designator = $instrument->reference_designator;
                $items[] = $testItem;
              }
            } // End instrument questions

            // Stream Questions
            if ($this->request->data['stream_questions']) {
              $questions = $this->TestQuestions->find('all')->where(['type'=>'stream']);
              foreach ($questions as $q) {
                foreach ($instrument->data_streams as $s) {
                  if ($this->request->data['stream']=='all' || $this->request->data['stream']==$s->id) {  
                    $testItem = $this->TestPlans->TestItems->newEntity();
                    $testItem->test_question_id = $q->id;
                    $testItem->reference_designator = $instrument->reference_designator;
                    $testItem->method = $s->method;
                    $testItem->stream_id = $s->stream_id;
                    $items[] = $testItem;
                  }
                }
              }
            } // End Stream Questions
            
            // Parameter Questions
            if ($this->request->data['parameter_questions']) {
              $questions = $this->TestQuestions->find('all')->where(['type'=>'parameter']);
              foreach ($questions as $q) {
                foreach ($instrument->data_streams as $s) {
                  if ($this->request->data['stream']=='all' || $this->request->data['stream']==$s->id) {  
                    foreach ($s->stream->parameters as $p) {
                      $testItem = $this->TestPlans->TestItems->newEntity();
                      $testItem->test_question_id = $q->id;
                      $testItem->reference_designator = $instrument->reference_designator;
                      $testItem->method = $s->method;
                      $testItem->stream_id = $s->stream_id;
                      $testItem->parameter_id = $p->id;
                      $items[] = $testItem;
                    }
                  }
                }
              }
            } // End parameter questions
            
            } //End foreach

            // Add items to test plan to save
            $testPlan->test_items = $items;
            if ($this->TestPlans->save($testPlan)) {
                $this->Flash->success( count($items) . ' test cases were added');
            } else {
                $this->Flash->error(__('The test cases could not be added.  Please try again.'));
            }
/*
          } else {
                $this->Flash->error(__('Please select an instrument first, in order to add test cases.'));
          }
*/
          $this->redirect(['action'=>'view', $testPlan->id]);
        }

    }



    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $testPlan = $this->TestPlans->newEntity();
        if ($this->request->is('post')) {
            $testPlan = $this->TestPlans->patchEntity($testPlan, $this->request->data, [
              'fieldList'=>['name','start_date','end_date']
            ]);
            $testPlan->user_id = $this->Auth->user('id');
            $testPlan->status = 'Draft';
            if ($this->TestPlans->save($testPlan)) {
                $this->Flash->success(__('The test plan has been saved.'));
                return $this->redirect(['action' => 'view', $testPlan->id]);
            } else {
                $this->Flash->error(__('The test plan could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('testPlan'));
        $this->set('_serialize', ['testPlan']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Test Plan id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $testPlan = $this->TestPlans->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $testPlan = $this->TestPlans->patchEntity($testPlan, $this->request->data, [
              'fieldList'=>['name','status','start_date','end_date']
            ]);
            $testPlan->user_id = $this->Auth->user('id');
            if ($this->TestPlans->save($testPlan)) {
                $this->Flash->success(__('The test plan has been saved.'));
                return $this->redirect(['action' => 'view', $testPlan->id]);
            } else {
                $this->Flash->error(__('The test plan could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('testPlan'));
        $this->set('_serialize', ['testPlan']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Test Plan id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $testPlan = $this->TestPlans->get($id);
        if ($this->TestPlans->delete($testPlan)) {
            $this->Flash->success(__('The test plan has been deleted.'));
        } else {
            $this->Flash->error(__('The test plan could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
