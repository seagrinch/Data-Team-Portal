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
        if (in_array($this->request->action, ['add','edit'])) {
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
            'contain' => ['Users', 'TestItems']
        ]);

        $this->set('testPlan', $testPlan);
        $this->set('_serialize', ['testPlan']);
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
              'fieldList'=>['name','status']
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
        $this->set(compact('testPlan', 'users'));
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
              'fieldList'=>['name','status']
            ]);
            $testPlan->user_id = $this->Auth->user('id');
            if ($this->TestPlans->save($testPlan)) {
                $this->Flash->success(__('The test plan has been saved.'));
                return $this->redirect(['action' => 'view', $testPlan->id]);
            } else {
                $this->Flash->error(__('The test plan could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('testPlan', 'users'));
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
