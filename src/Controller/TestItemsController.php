<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TestItems Controller
 *
 * @property \App\Model\Table\TestItemsTable $TestItems
 */
class TestItemsController extends AppController
{

    /**
     * isAuthorized method
     */
    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['edit','delete'])) {
            return true;
        }        
        return parent::isAuthorized($user);
    }

    /**
     * Edit method
     *
     * @param string|null $id Test Item id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $testItem = $this->TestItems->get($id, [
            'contain' => ['TestRuns','Streams','Parameters']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $testItem = $this->TestItems->patchEntity($testItem, $this->request->data,[
              'fieldList'=>['status_complete','status_reasonable','comment','redmine_issue']
            ]);
            if ($this->TestItems->save($testItem)) {
                $this->Flash->success(__('The test result has been saved.'));
                return $this->redirect(['controller'=>'test_runs','action' => 'view',$testItem->test_run_id]);
            } else {
                $this->Flash->error(__('The test result could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('testItem'));
        $this->set('_serialize', ['testItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Test Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $testItem = $this->TestItems->get($id);
        if ($this->TestItems->delete($testItem)) {
            $this->Flash->success(__('The test item has been deleted.'));
        } else {
            $this->Flash->error(__('The test item could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller'=>'test_runs','action' => 'view',$testItem->test_run_id]);
    }
}
