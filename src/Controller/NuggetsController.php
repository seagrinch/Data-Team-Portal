<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Nuggets Controller
 *
 * @property \App\Model\Table\NuggetsTable $Nuggets
 *
 * @method \App\Model\Entity\Nugget[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NuggetsController extends AppController
{

    /**
     * isAuthorized method
     */
    public function isAuthorized($user)
    {
        // All registered users can add or edit
        if (in_array($this->request->action, ['add','edit'])) {
            return true;
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
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $nuggets = $this->paginate($this->Nuggets);

        $this->set(compact('nuggets'));
    }

    /**
     * View method
     *
     * @param string|null $id Nugget id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $nugget = $this->Nuggets->get($id, [
            'contain' => []
        ]);

        $this->set('nugget', $nugget);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $nugget = $this->Nuggets->newEntity();
        if ($this->request->is('post')) {
            $nugget = $this->Nuggets->patchEntity($nugget, $this->request->getData());
            if ($this->Nuggets->save($nugget)) {
                $this->Flash->success(__('The nugget has been saved.'));
                return $this->redirect(['action' => 'view', $nugget->id]);
            }
            $this->Flash->error(__('The nugget could not be saved. Please, try again.'));
        }
        $this->set(compact('nugget'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Nugget id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $nugget = $this->Nuggets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $nugget = $this->Nuggets->patchEntity($nugget, $this->request->getData());
            if ($this->Nuggets->save($nugget)) {
                $this->Flash->success(__('The nugget has been saved.'));
                return $this->redirect(['action' => 'view', $nugget->id]);
            }
            $this->Flash->error(__('The nugget could not be saved. Please, try again.'));
        }
        $this->set(compact('nugget'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Nugget id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $nugget = $this->Nuggets->get($id);
        if ($this->Nuggets->delete($nugget)) {
            $this->Flash->success(__('The nugget has been deleted.'));
        } else {
            $this->Flash->error(__('The nugget could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
