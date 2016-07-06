<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TestQuestions Controller
 *
 * @property \App\Model\Table\TestQuestionsTable $TestQuestions
 */
class TestQuestionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $testQuestions = $this->paginate($this->TestQuestions);

        $this->set(compact('testQuestions'));
        $this->set('_serialize', ['testQuestions']);
    }

    /**
     * View method
     *
     * @param string|null $id Test Question id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $testQuestion = $this->TestQuestions->get($id, [
            'contain' => ['TestRuns']
        ]);

        $this->set('testQuestion', $testQuestion);
        $this->set('_serialize', ['testQuestion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $testQuestion = $this->TestQuestions->newEntity();
        if ($this->request->is('post')) {
            $testQuestion = $this->TestQuestions->patchEntity($testQuestion, $this->request->data);
            if ($this->TestQuestions->save($testQuestion)) {
                $this->Flash->success(__('The test question has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The test question could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('testQuestion'));
        $this->set('_serialize', ['testQuestion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Test Question id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $testQuestion = $this->TestQuestions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $testQuestion = $this->TestQuestions->patchEntity($testQuestion, $this->request->data);
            if ($this->TestQuestions->save($testQuestion)) {
                $this->Flash->success(__('The test question has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The test question could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('testQuestion'));
        $this->set('_serialize', ['testQuestion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Test Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $testQuestion = $this->TestQuestions->get($id);
        if ($this->TestQuestions->delete($testQuestion)) {
            $this->Flash->success(__('The test question has been deleted.'));
        } else {
            $this->Flash->error(__('The test question could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
