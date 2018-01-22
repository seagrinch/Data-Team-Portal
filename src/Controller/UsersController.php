<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;
use Cake\Mailer\MailerAwareTrait;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    use MailerAwareTrait;

    /**
     * beforeFilter method
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['logout','requestResetPassword','resetPassword']);
        $this->Auth->deny(['index','view']);
    }

    /**
     * isAuthorized method
     */
    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['profile', 'update','index','view'])) {
            return true;
        }        
        return parent::isAuthorized($user);
    }

    /**
     * Login method
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if($this->request->data('remember_me')) {
                  $this->Cookie->configKey('CookieAuth', [
                    'expires' => '+1 month',
                    'httpOnly' => true
                  ]);
                  $this->Cookie->write('CookieAuth', [
                    'username' => $this->request->data('username'),
                    'password' => $this->request->data('password')
                  ]);
                }
                $this->Flash->success(__('You have successfully logged in.'));
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, please try again'));
        }
    }

    /**
     * Logout method
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
    /**
     * Index method - redirects to profile
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }


    /**
     * View method
     *
     * @param string|null $id Region id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($username = null) {
      $query = $this->Users->findByUsername($username);
      $user = $query->first();
      if (empty($user)) {
          throw new NotFoundException(__('User not found'));
      }
      
      $notes = $this->Users->Notes->find('all')
        ->where(['user_id'=> $user['id'], 'type'=>'issue'])
        ->order(['modified'=>'DESC']);
      $user->notes = $notes;
      
      $cruise_reviews = $this->Users->CruiseReviews->find('all')
        ->where(['user_id'=> $user['id'], 'status !='=>'Complete'])
        ->order(['modified'=>'DESC'])
        ->contain(['Cruises']);
      $user->cruise_reviews = $cruise_reviews;
      
      $this->set('user', $user);
      $this->set('_serialize', ['user']);
    }


    /**
     * Profile method
     *
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function profile()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => []
        ]);
        return $this->redirect(['action'=>'view',$user->username]);
    }

    /**
     * Update method
     *
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function update()
    {
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => []
        ]);
        unset($user->password);  //Remove password from array
        if ($this->request->is(['patch', 'post', 'put'])) {          
            $user->id = $this->Auth->user('id'); // Manually override id
            if (empty($this->request->data['password'])) {
              unset($this->request->data['password']);  //If the password isn't set, remove it to prevent validation
            }
            $user = $this->Users->patchEntity($user, $this->request->data, [
                'fieldList'=>['password','email','first_name','last_name']
            ]);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your profile was updated.'));
                $this->Auth->setUser($user->toArray()); //Update session info
                return $this->redirect(['action' => 'profile']);
            } else {
                $this->Flash->error(__('Your profile could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }


    /**
     * Request Password Reset
     */
    public function requestResetPassword() {
      //if ($this->Auth->login()) {
      //  return $this->redirect($this->Auth->redirectUrl());  //Redirect if already logged in
      //}
      if ($this->request->is(['patch', 'post', 'put'])) {          
        $query = $this->Users->findAllByUsernameOrEmail($this->request->data['email'],$this->request->data['email']);
        $user = $query->first();
        if ($user) {
          $user->updateToken(60*60*24*2); //Expire in 2 Days
          $this->Users->save($user);
          $this->getMailer('User')->send('resetPassword', [$user]);
          $this->Flash->success('Instructions on how to reset your password were set to your email address.');
  				$this->redirect(['action'=>'login']);
        } else {
          $this->Flash->error('The entered email address could not be found. Please try again.');
        }
      }
    }
  
    /**
     * Reset Password
     */
    public function resetPassword($token=null) {
        $query = $this->Users->find()
          ->where(['token'=>$token, 'token_expires >'=>date('Y-m-d H:i:s')]);
        $user = $query->first();
        
        if (empty($user)) {
            $this->Flash->error('The specified token is invalid. Please, check the link and try again or request a new password reset link below.');
            $this->redirect(['action'=>'requestResetPassword']);
        } else {
            if ($this->request->is(['patch', 'post', 'put'])) {          
                $user = $this->Users->patchEntity($user, $this->request->data, [
                    'fieldList'=>['password']
                ]);
                $user->token='';
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Your password has been changed.'));
                    $this->Auth->setUser($user->toArray()); //Manually log in user
                    return $this->redirect(['action' => 'profile']);
                } else {
                    $this->Flash->error(__('Your password could not be updated. Please, try again.'));
                }
            }
            unset($user->password);  //Remove password from array
            $this->set(compact('user'));
        }
    }


}
