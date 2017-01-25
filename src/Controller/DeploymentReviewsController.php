<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

/**
 * DeploymentReviews Controller
 *
 * @property \App\Model\Table\DeploymentReviewsTable $DeploymentReviews
 */
class DeploymentReviewsController extends AppController
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
          'sortWhitelist' => [
            'reference_designator', 'deployment', 'status', 'Users.username', 'percent_good', 'modified'
          ]
        ];
        $deploymentReviews = $this->paginate($this->DeploymentReviews);

        $this->set(compact('deploymentReviews'));
        $this->set('_serialize', ['deploymentReviews']);
    }

    /**
     * View method
     *
     * @param string|null $id Deployment Review id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($rd = null, $dn = null)
    {
        $query = $this->DeploymentReviews->find()
          ->where(['reference_designator'=>$rd,'deployment_number'=>$dn])
          ->contain(['Users']);
        $deploymentReview = $query->first();

        if (empty($deploymentReview)) {
            throw new NotFoundException(__('Deployment Review not found'));
        }

        $this->set('deploymentReview', $deploymentReview);
        $this->set('_serialize', ['deploymentReview']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deploymentReview = $this->DeploymentReviews->newEntity();
        if ($this->request->is('post')) {
            $deploymentReview = $this->DeploymentReviews->patchEntity($deploymentReview, $this->request->data);
            $deploymentReview->user_id = $this->Auth->user('id');
            $deploymentReview->status = 'Not Started';
            if ($this->DeploymentReviews->save($deploymentReview)) {
                $this->Flash->success(__('The deployment review has been saved.'));

                return $this->redirect(['action' => 'view', $deploymentReview->reference_designator, $deploymentReview->deployment_number]);
            } else {
                $this->Flash->error(__('The deployment review could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('deploymentReview'));
        $this->set('_serialize', ['deploymentReview']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Deployment Review id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($rd = null, $dn = null)
    {
        $query = $this->DeploymentReviews->find()
          ->where(['reference_designator'=>$rd,'deployment_number'=>$dn])
          ->contain(['Users']);
        $deploymentReview = $query->first();

        if (empty($deploymentReview)) {
            throw new NotFoundException(__('Deployment Review not found'));
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $deploymentReview = $this->DeploymentReviews->patchEntity($deploymentReview, $this->request->data);
            if ($this->DeploymentReviews->save($deploymentReview)) {
                $this->Flash->success(__('The deployment review has been saved.'));

                return $this->redirect(['action' => 'view', $deploymentReview->reference_designator, $deploymentReview->deployment_number]);
            } else {
                $this->Flash->error(__('The deployment review could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('deploymentReview'));
        $this->set('_serialize', ['deploymentReview']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Deployment Review id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deploymentReview = $this->DeploymentReviews->get($id);
        if ($this->DeploymentReviews->delete($deploymentReview)) {
            $this->Flash->success(__('The deployment review has been deleted.'));
        } else {
            $this->Flash->error(__('The deployment review could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
