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
     * beforeFilter method
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['all']);
    }

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
          'contain' => ['Cruises']
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
          ->contain(['Cruises']);
        $cruiseReview = $query->first();

        if (empty($cruiseReview)) {
            throw new NotFoundException(__('Cruise Review not found'));
        }

        $this->set('cruiseReview', $cruiseReview);
        $this->set('_serialize', ['cruiseReview']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cruiseReview = $this->CruiseReviews->newEntity();
        if ($this->request->is('post')) {
            $cruiseReview = $this->CruiseReviews->patchEntity($cruiseReview, $this->request->data);
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
          ->contain(['Cruises']);
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
        $this->set(compact('cruiseReview'));
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
