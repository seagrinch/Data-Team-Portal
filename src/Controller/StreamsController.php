<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Streams Controller
 *
 * @property \App\Model\Table\StreamsTable $Streams
 */
class StreamsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $streams = $this->paginate($this->Streams);

        $this->set(compact('streams'));
        $this->set('_serialize', ['streams']);
    }

    /**
     * View method
     *
     * @param string|null $id Stream id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $stream = $this->Streams->get($id, [
            'contain' => ['Designators', 'Parameters']
        ]);

        $this->set('stream', $stream);
        $this->set('_serialize', ['stream']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function admin_add()
    {
        $stream = $this->Streams->newEntity();
        if ($this->request->is('post')) {
            $stream = $this->Streams->patchEntity($stream, $this->request->data);
            if ($this->Streams->save($stream)) {
                $this->Flash->success(__('The stream has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The stream could not be saved. Please, try again.'));
            }
        }
        $designators = $this->Streams->Designators->find('list', ['limit' => 200]);
        $parameters = $this->Streams->Parameters->find('list', ['limit' => 200]);
        $this->set(compact('stream', 'designators', 'parameters'));
        $this->set('_serialize', ['stream']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Stream id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function admin_edit($id = null)
    {
        $stream = $this->Streams->get($id, [
            'contain' => ['Designators', 'Parameters']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $stream = $this->Streams->patchEntity($stream, $this->request->data);
            if ($this->Streams->save($stream)) {
                $this->Flash->success(__('The stream has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The stream could not be saved. Please, try again.'));
            }
        }
        $designators = $this->Streams->Designators->find('list', ['limit' => 200]);
        $parameters = $this->Streams->Parameters->find('list', ['limit' => 200]);
        $this->set(compact('stream', 'designators', 'parameters'));
        $this->set('_serialize', ['stream']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Stream id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function admin_delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $stream = $this->Streams->get($id);
        if ($this->Streams->delete($stream)) {
            $this->Flash->success(__('The stream has been deleted.'));
        } else {
            $this->Flash->error(__('The stream could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
