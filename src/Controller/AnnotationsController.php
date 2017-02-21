<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Annotations Controller
 *
 * @property \App\Model\Table\AnnotationsTable $Annotations
 */
class AnnotationsController extends AppController
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
            if ($this->Annotations->isOwnedBy($id, $user['id'])) {
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
        $annotations = $this->paginate($this->Annotations);

        $this->set(compact('annotations'));
        $this->set('_serialize', ['annotations']);
    }

    /**
     * View method
     *
     * @param string|null $id Annotation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $annotation = $this->Annotations->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('annotation', $annotation);
        $this->set('_serialize', ['annotation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($type=null,$reference_designator=null,$deployment=null)
    {
        if (strlen($reference_designator)==8) {
            $this->loadModel('Sites');
            $query = $this->Sites->find()
              ->where(['Sites.reference_designator'=>$reference_designator]);
            $rd = $query->first();
            $model='sites';
        } elseif (strlen($reference_designator)==14) {
            $this->loadModel('Nodes');
            $query = $this->Nodes->find()
              ->where(['Nodes.reference_designator'=>$reference_designator]);
            $rd = $query->first();
            $model='nodes';
        } elseif (strlen($reference_designator)==27 && ($this->request->query('method')) && ($this->request->query('stream'))) {
            $this->loadModel('DataStreams');
            $query = $this->DataStreams->find()
              ->where([
                'reference_designator'=>$reference_designator,
                'method'=>$this->request->query('method'),
                'stream_name'=>$this->request->query('stream')
              ]);
            $rd = $query->first();
            $model='data_streams';
        } elseif (strlen($reference_designator)==27) {
            $this->loadModel('Instruments');
            $query = $this->Instruments->find()
              ->where(['Instruments.reference_designator'=>$reference_designator]);
            $rd = $query->first();
            $model='instruments';
        }

        if (empty($rd)) {
            throw new NotFoundException(__('Reference Designator not found'));
        }

        $annotation = $this->Annotations->newEntity();
        $annotation->model = $model;
        $annotation->type = $type;
        $annotation->reference_designator = $rd->reference_designator;
        $annotation->deployment = $deployment;
        $annotation->method = $this->request->query('method');
        $annotation->stream = $this->request->query('stream');
        $annotation->parameter = $this->request->query('parameter');
        
        if ($this->request->is('post')) {
            $annotation = $this->Annotations->patchEntity($annotation, $this->request->data, [
              'fieldList'=>['type','comment','deployment','start_date','end_date','redmine_issue','status','exclusion_flag']
            ]);
            $annotation->user_id = $this->Auth->user('id');
            if ($this->Annotations->save($annotation)) {
                $this->Flash->success(__('The annotation has been saved.'));
                if ($annotation->model=='data_streams') {
                  return $this->redirect([
                    'controller'=>'data_streams', 
                    'action'=>'view', 
                    $rd->id 
                  ]);
                } else {
                  return $this->redirect([
                    'controller'=>$annotation->model, 
                    'action'=>'view', 
                    $rd->reference_designator, 
                    '#'=>$annotation->type . 's'
                  ]);
                }
            } else {
                $this->Flash->error(__('The annotation could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('annotation'));
        $this->set('_serialize', ['annotation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Annotation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $annotation = $this->Annotations->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $annotation = $this->Annotations->patchEntity($annotation, $this->request->data, [
              'fieldList'=>['type','comment','deployment','start_date','end_date','redmine_issue','resolved_date','status','exclusion_flag']
            ]);
            if ($this->Annotations->save($annotation)) {
                $this->Flash->success(__('The annotation has been updated.'));
                if ($annotation->model=='data_streams') {
                  $this->loadModel('DataStreams');
                  $query = $this->DataStreams->find()
                    ->where([
                    'reference_designator'=>$annotation->reference_designator,
                    'method'=>$annotation->method,
                    'stream_name'=>$annotation->stream
                  ]);
                  $rd = $query->first();
                  return $this->redirect([
                    'controller'=>'data_streams', 
                    'action'=>'view', 
                    $rd->id 
                  ]);                  
                } else {
                  return $this->redirect([
                    'controller'=>$annotation->model, 
                    'action'=>'view', 
                    $annotation->reference_designator, 
                    '#'=>'annotations'
                  ]);
                }
            } else {
                $this->Flash->error(__('The annotation could not be updated. Please, try again.'));
            }
        }
        $this->set(compact('annotation'));
        $this->set('_serialize', ['annotation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Annotation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $annotation = $this->Annotations->get($id);
        if ($this->Annotations->delete($annotation)) {
            $this->Flash->success(__('The annotation has been deleted.'));
        } else {
            $this->Flash->error(__('The annotation could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
