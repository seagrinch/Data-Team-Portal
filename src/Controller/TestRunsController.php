<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * TestRuns Controller
 *
 * @property \App\Model\Table\TestRunsTable $TestRuns
 */
class TestRunsController extends AppController
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
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $id = (int)$this->request->params['pass'][0];
            if ($this->TestRuns->isOwnedBy($id, $user['id'])) {
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
        $testRuns = $this->paginate($this->TestRuns);

        $this->set(compact('testRuns'));
        $this->set('_serialize', ['testRuns']);
    }

    /**
     * View method
     *
     * @param string|null $id Test Run id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $testRun = $this->TestRuns->get($id, [
            'contain' => ['Users']
        ]);

        $this->paginate = [
         'TestItems'=> [
          'contain' => ['Streams','Parameters'],
          'sortWhitelist' => ['method', 'Streams.name','Parameters.name','status_complete','status_reasonable'],
          'limit' => 1000
         ]
        ];
        $query = $this->TestRuns->TestItems->find('all')
          ->contain(['Streams','Parameters'])
          ->where(['test_run_id' => $id]);
        $testItems = $this->paginate($query);

        $this->set(compact('testRun','testItems'));
        $this->set('_serialize', ['testRun','testItems']);
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
    public function add($reference_designator=null)
    {
        $this->loadModel('Instruments');
        $query = $this->Instruments->find()
          ->where(['Instruments.reference_designator'=>$reference_designator])
          ->contain(['DataStreams.Streams.Parameters']);
        $instrument = $query->first();
        
        if (empty($instrument)) {
            throw new NotFoundException(__('Reference Designator not found'));
        }

        $testRun = $this->TestRuns->newEntity();
        $testRun->reference_designator = $instrument->reference_designator;
        if ($this->request->is('post')) {
            $testRun = $this->TestRuns->patchEntity($testRun, $this->request->data, [
              'fieldList'=>['name','deployment','start_date','end_date']
            ]);
            $testRun->user_id = $this->Auth->user('id');
            $testRun->status = 'Draft';
            if ($this->TestRuns->save($testRun)) {
                // Add Parameter Test Items
                $items = [];
                foreach ($instrument->data_streams as $s) {
                  //if ($this->request->data['stream']=='all' || $this->request->data['stream']==$s->id) {  
                  foreach ($s->stream->parameters as $p) {
                    $testItem = $this->TestRuns->TestItems->newEntity();
                    $testItem->method = $s->method;
                    $testItem->stream_id = $s->stream_id;
                    $testItem->parameter_id = $p->id;
                    $items[] = $testItem;
                  }
                  //}
                }
                // Add items to Test Run to save
                $testRun->test_items = $items;
                if ($this->TestRuns->save($testRun)) {
                    $this->Flash->success('The test run has been created with ' . count($items) . ' tests added');
                } else {
                    $this->Flash->error(__('The test run was created, but tests could not be added.  Please try again.'));
                }
                //$this->Flash->success(__('The test run has been saved.'));
                //return $this->redirect(['action' => 'view', $testRun->id]);
                return $this->redirect(['controller'=>'instruments', 'action' => 'view', $testRun->reference_designator, '#'=>'tests']);
            } else {
                $this->Flash->error(__('The test could not be created. Please, try again.'));
            }
        }
        $this->set(compact('testRun'));
        $this->set('_serialize', ['testRun']);

    }

    /**
     * Edit method
     *
     * @param string|null $id Test Run id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $testRun = $this->TestRuns->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $testRun = $this->TestRuns->patchEntity($testRun, $this->request->data, [
              'fieldList'=>['name','deployment','start_date','end_date','status','comment']
            ]);
            //$testRun->user_id = $this->Auth->user('id');
            if ($this->TestRuns->save($testRun)) {
                $this->Flash->success(__('The test run has been saved.'));
                return $this->redirect(['action' => 'view', $testRun->id]);
            } else {
                $this->Flash->error(__('The test run could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('testRun'));
        $this->set('_serialize', ['testRun']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Test Run id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $testRun = $this->TestRuns->get($id);
        if ($this->TestRuns->delete($testRun)) {
            $this->Flash->success(__('The test run has been deleted.'));
        } else {
            $this->Flash->error(__('The test run could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
