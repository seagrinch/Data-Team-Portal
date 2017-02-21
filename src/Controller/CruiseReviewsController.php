<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

/**
 * CruiseReviews Controller
 *
 * @property \App\Model\Table\CruiseReviewsTable $CruiseReviews
 */
class CruiseReviewsController extends AppController
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
          'limit' => 25,
          'order' => ['Cruises.cruise_start_date' => 'desc'],
          'contain' => ['Cruises','Users'],
          'sortWhitelist' => [
            'cruise_cuid', 'status', 'Users.username', 'Cruises.ship_name', 
            'Cruises.notes', 'Cruises.cruise_start_date', 'Cruises.cruise_end_date', 'modified'
          ]
        ];
        $cruiseReviews = $this->paginate($this->CruiseReviews);

        $this->set(compact('cruiseReviews'));
        $this->set('_serialize', ['cruiseReviews']);
    }

    /**
     * View method
     *
     * @param string|null $id Cruise Review id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($cuid = null)
    {
        $query = $this->CruiseReviews->find()
          ->where(['cruise_cuid'=>$cuid])
          ->contain(['Cruises','Users']);
        $cruiseReview = $query->first();

        if (empty($cruiseReview)) {
          //throw new NotFoundException(__('Cruise Review not found'));
          return $this->redirect(['action' => 'add', $cuid]);
        }

        $this->set('cruiseReview', $cruiseReview);
        $this->set('_serialize', ['cruiseReview']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($cuid=null)
    {
        $cruiseReview = $this->CruiseReviews->newEntity();
        $cruiseReview->cruise_cuid = $cuid;
        if ($this->request->is('post')) {
            $cruiseReview = $this->CruiseReviews->patchEntity($cruiseReview, $this->request->data);
            $cruiseReview->user_id = $this->Auth->user('id');
            $cruiseReview->status = 'Not Started';
            if ($this->CruiseReviews->save($cruiseReview)) {
                $this->Flash->success(__('The cruise review has been saved.'));
                return $this->redirect(['action' => 'view', $cruiseReview->cruise_cuid]);
            } else {
                $this->Flash->error(__('The cruise review could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('cruiseReview'));
        $this->set('_serialize', ['cruiseReview']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cruise Review id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($cuid = null)
    {
        $query = $this->CruiseReviews->find()
          ->where(['cruise_cuid'=>$cuid])
          ->contain(['Cruises','Users']);
        $cruiseReview = $query->first();
        
        if (empty($cruiseReview)) {
            throw new NotFoundException(__('Cruise Review not found'));
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $cruiseReview = $this->CruiseReviews->patchEntity($cruiseReview, $this->request->data);
            if ($this->CruiseReviews->save($cruiseReview)) {
                $this->Flash->success(__('The cruise review has been saved.'));

                return $this->redirect(['action' => 'view', $cruiseReview->cruise_cuid]);
            } else {
                $this->Flash->error(__('The cruise review could not be saved. Please, try again.'));
            }
        }
        $users = $this->CruiseReviews->Users->find('list', ['limit' => 200, 'valueField'=>'full_name']);
        $this->set(compact('cruiseReview','users'));
        $this->set('_serialize', ['cruiseReview']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cruise Review id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cruiseReview = $this->CruiseReviews->get($id);
        if ($this->CruiseReviews->delete($cruiseReview)) {
            $this->Flash->success(__('The cruise review has been deleted.'));
        } else {
            $this->Flash->error(__('The cruise review could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
