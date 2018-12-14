<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;

/**
 * Reviews Controller
 *
 *
 * @method \App\Model\Entity\Review[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReviewsController extends AppController
{
  
    /**
     * beforeFilter method
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['status']);
    }

    /**
     * isAuthorized method
     */
    public function isAuthorized($user)
    {
        // Only registered users can edit or delete
        if (in_array($this->request->action, ['edit', 'delete'])) {
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
     * @return \Cake\Network\Response|null
     */
    public function index($site=null,$status=null) {
      $query = $this->Reviews->find('all');
      if ($site) {
        $query->where(['reference_designator LIKE'=>$site.'%']);
      }
      if ($status) {
        $query->where(['status'=>$status]);
      }
      if ($this->request->is('json') ) { //Formerly ajax
        $this->paginate = [
          'limit' => 2000, 
          'maxLimit' => 2000,
        ];
        $this->set('_serialize', false);
      }
      $this->set('reviews',$this->paginate($query));
    }


    /**
     * Edit method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $review = $this->Reviews->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $review = $this->Reviews->patchEntity($review, $this->request->getData(), [
              'fieldList'=>['user_id','status','notes','completed_date']
            ]);
            $review->user_id = $this->Auth->user('id');
            if ($this->Reviews->save($review)) {
                $this->Flash->success(__('The review has been updated.'));
                return $this->redirect(['controller'=>'instruments', 'action'=>'report', $review->reference_designator]);
            }
            $this->Flash->error(__('The review could not be saved. Please, try again.'));
        }
        $this->set(compact('review'));
    }


    /**
     * Status method
     */
    public function status() {
        $query = $this->Reviews->find();
        $query->select(['region'=>'LEFT(reference_designator,2)','status','count' => $query->func()->count('*')])
          ->group(['LEFT(reference_designator,2)','status']);
        $status = $query->all()->toArray();
        
        $this->set(compact(['status']));      
        $this->set('_serialize', ['status']);
    }


    /**
     * Delete method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $review = $this->Reviews->get($id);
        if ($this->Reviews->delete($review)) {
            $this->Flash->success(__('The review has been deleted.'));
            return $this->redirect(['controller'=>'instruments', 'action'=>'report', $review->reference_designator]);
        } else {
            $this->Flash->error(__('The review could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
