<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Reviews Controller
 *
 *
 * @method \App\Model\Entity\Review[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReviewsController extends AppController
{
  
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
