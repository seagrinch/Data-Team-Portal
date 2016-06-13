<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DataStreams Controller
 *
 * @property \App\Model\Table\DataStreamsTable $DataStreams
 */
class DataStreamsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Instruments', 'Streams']
        ];
        $dataStreams = $this->paginate($this->DataStreams);

        $this->set(compact('dataStreams'));
        $this->set('_serialize', ['dataStreams']);
    }

    /**
     * View method
     *
     * @param string|null $id Data Stream id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dataStream = $this->DataStreams->get($id, [
            'contain' => ['Instruments', 'Streams']
        ]);

        $this->set('dataStream', $dataStream);
        $this->set('_serialize', ['dataStream']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function admin_add()
    {
        $dataStream = $this->DataStreams->newEntity();
        if ($this->request->is('post')) {
            $dataStream = $this->DataStreams->patchEntity($dataStream, $this->request->data);
            if ($this->DataStreams->save($dataStream)) {
                $this->Flash->success(__('The data stream has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The data stream could not be saved. Please, try again.'));
            }
        }
        $instruments = $this->DataStreams->Instruments->find('list', ['limit' => 200]);
        $streams = $this->DataStreams->Streams->find('list', ['limit' => 200]);
        $this->set(compact('dataStream', 'instruments', 'streams'));
        $this->set('_serialize', ['dataStream']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Data Stream id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function admin_edit($id = null)
    {
        $dataStream = $this->DataStreams->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dataStream = $this->DataStreams->patchEntity($dataStream, $this->request->data);
            if ($this->DataStreams->save($dataStream)) {
                $this->Flash->success(__('The data stream has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The data stream could not be saved. Please, try again.'));
            }
        }
        $instruments = $this->DataStreams->Instruments->find('list', ['limit' => 200]);
        $streams = $this->DataStreams->Streams->find('list', ['limit' => 200]);
        $this->set(compact('dataStream', 'instruments', 'streams'));
        $this->set('_serialize', ['dataStream']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Data Stream id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function admin_delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dataStream = $this->DataStreams->get($id);
        if ($this->DataStreams->delete($dataStream)) {
            $this->Flash->success(__('The data stream has been deleted.'));
        } else {
            $this->Flash->error(__('The data stream could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
