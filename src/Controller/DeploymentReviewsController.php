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
        // All registered users can add
        if (in_array($this->request->action, ['add'])) {
            return true;
        }
        // Only the owner of an item can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $id = (int)$this->request->params['pass'][0];
            if ($this->DeploymentReviews->isOwnedBy($id, $user['id'])) {
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
          //throw new NotFoundException(__('Deployment Review not found'));
          return $this->redirect(['action' => 'add', $rd, $dn]);
        }

        $this->loadModel('Deployments');
        $query = $this->Deployments->find()
          ->where(['reference_designator'=> $rd, 'deployment_number'=>$dn]);
        $deployment = $query->first();
  
        $this->loadModel('Assets');
        $query = $this->Assets->find('all')
          ->where(['asset_uid'=> $deployment['sensor_uid']]);
        $asset = $query->first();
  
        $this->loadModel('Ingestions');
        $ingestions = $this->Ingestions->find('all')
          ->where(['reference_designator'=> $rd, 'deployment'=>$dn]);

        $this->loadModel('Annotations');
        $annotations = $this->Annotations->find('all')
          ->where(['reference_designator'=> $rd])
          ->orWhere(['reference_designator'=> substr($rd,0,14)])
          ->orWhere(['reference_designator'=> substr($rd,0,8)])
          ->andWhere(['start_datetime >='=>$deployment['start_date']->modify('-1 day')->i18nFormat('yyyy-MM-dd')]) 
          ->order(['start_datetime'=>'ASC']);
        if ($deployment['stop_date']) {
          $annotations->andWhere(['end_datetime <='=>$deployment['stop_date']->modify('+1 day')->i18nFormat('yyyy-MM-dd')]);
        }

        $this->loadModel('Notes');
        $notes = $this->Notes->find('all')
          ->where(['reference_designator'=> $rd])
          ->orWhere(['reference_designator'=> substr($rd,0,14)])
          ->orWhere(['reference_designator'=> substr($rd,0,8)])
          ->andWhere(['start_date >='=>$deployment['start_date']->modify('-1 day')->i18nFormat('yyyy-MM-dd')]) 
          ->order(['start_date'=>'ASC']);
        if ($deployment['stop_date']) {
          $notes->andWhere(['end_date <='=>$deployment['stop_date']->modify('+1 day')->i18nFormat('yyyy-MM-dd')]);
        }

        $this->set(compact('deploymentReview','deployment','asset','ingestions','annotations','notes'));
        $this->set('_serialize', ['deploymentReview']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($rd = null, $dn = null)
    {
        $deploymentReview = $this->DeploymentReviews->newEntity();
        $deploymentReview->reference_designator = $rd;
        $deploymentReview->deployment_number = $dn;
        if ($this->request->is('post')) {
            $deploymentReview = $this->DeploymentReviews->patchEntity($deploymentReview, $this->request->data);
            $deploymentReview->user_id = $this->Auth->user('id');
            $deploymentReview->status = 'Not Started';
            if ($this->DeploymentReviews->save($deploymentReview)) {
                $this->Flash->success(__('This new deployment review has been setup.'));

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
          // throw new NotFoundException(__('Deployment Review not found'));
          return $this->redirect(['action' => 'add', $rd, $dn]);
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
        $users = $this->DeploymentReviews->Users->find('list', ['limit' => 200, 'valueField'=>'full_name']);
        $this->set(compact('deploymentReview','users'));
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
