<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Notes Controller
 *
 * @property \App\Model\Table\NotesTable $Notes
 */
class NotesController extends AppController
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
            if ($this->Notes->isOwnedBy($id, $user['id'])) {
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
            'sortWhitelist' => ['reference_designator', 'Users.first_name', 'created','type']
        ];
        $notes = $this->paginate($this->Notes);

        $this->set(compact('notes'));
        $this->set('_serialize', ['notes']);
    }

    /**
     * View method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('note', $note);
        $this->set('_serialize', ['note']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($model=null,$reference_designator=null)
    {
        if ($model=='sites') {
          $this->loadModel('Sites');
          $query = $this->Sites->find()
            ->where(['Sites.reference_designator'=>$reference_designator]);
          $rd = $query->first();
        } elseif ($model=='nodes') {
          $this->loadModel('Nodes');
          $query = $this->Nodes->find()
            ->where(['Nodes.reference_designator'=>$reference_designator]);
          $rd = $query->first();
        } elseif ($model=='instruments') {
          $this->loadModel('Instruments');
          $query = $this->Instruments->find()
            ->where(['Instruments.reference_designator'=>$reference_designator]);
          $rd = $query->first();
        }

        if (empty($rd)) {
            throw new NotFoundException(__('Reference Designator not found'));
        }

        $note = $this->Notes->newEntity();
        $note->model = $model;
        $note->reference_designator = $rd->reference_designator;
        if ($this->request->is('post')) {
            $note = $this->Notes->patchEntity($note, $this->request->data, [
              'fieldList'=>['comment','type','deployment','start_date','end_date','redmine_issue']
            ]);
            $note->user_id = $this->Auth->user('id');
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));
                return $this->redirect(['controller'=>$model, 'action'=>'view', $rd->reference_designator, '#'=>'notes']);
            } else {
                $this->Flash->error(__('The note could not be saved. Please, try again.'));
            }
        }
        //$users = $this->Notes->Users->find('list', ['limit' => 200]);
        $this->set(compact('note', 'users'));
        $this->set('_serialize', ['note']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $note = $this->Notes->patchEntity($note, $this->request->data, [
              'fieldList'=>['comment','type','deployment','start_date','end_date','redmine_issue','resolved_date','resolved_comment']
            ]);
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));
                return $this->redirect(['controller'=>$note->model, 'action'=>'view', $note->reference_designator, '#'=>'notes']);
            } else {
                $this->Flash->error(__('The note could not be saved. Please, try again.'));
            }
        }
        //$users = $this->Notes->Users->find('list', ['limit' => 200]);
        $this->set(compact('note', 'users'));
        $this->set('_serialize', ['note']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Note id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $note = $this->Notes->get($id);
        if ($this->Notes->delete($note)) {
            $this->Flash->success(__('The note has been deleted.'));
        } else {
            $this->Flash->error(__('The note could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
