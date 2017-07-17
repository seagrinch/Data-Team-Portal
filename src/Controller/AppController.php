<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Security', ['blackHoleCallback' => 'forceSSL']);
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'], 
            'loginAction' => ['prefix'=>false, 'controller'=>'Users', 'action'=>'login'],
            'loginRedirect' => ['prefix'=>false, 'controller' => 'Regions', 'action' => 'index'],
            'logoutRedirect' => ['prefix'=>false, 'controller' => 'Regions', 'action' => 'index'],
            'flash' => ['element' => 'error','key' => 'auth'], //Bootstrap
        ]);
    }

    /**
     * Before filter callback.
     *
     * @param \Cake\Event\Event $event The beforeFilter event.
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        // Require SSL if not localhost
        //if (strcasecmp(env('SERVER_NAME'),'data-team.localhost') != 0) {
        //  $this->Security->requireSecure(); 
        //}
        // Allow default non-admin routes
        if (empty($this->request->params['prefix'])) {
            $this->Auth->allow(['index', 'view', 'display']);
        }
        //Disable auth messages when not yet logged in.
        if (!$this->Auth->user()) {
            $this->Auth->config('authError', false);
        }
    }
    
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function isAuthorized($user)
    {
        // Only admins can access admin functions
        if (isset($this->request->params['prefix']) && ($this->request->params['prefix'] === 'admin')) {
            return (bool)($user['role'] === 'admin');
        }
    
        // Default deny
        return false;
    }

    /**
     * forceSSL function.
     * 
     * @access public
     * @return void
     */
    public function forceSSL()
    {
        return $this->redirect('https://' . env('SERVER_NAME') . $this->request->here);
    }

}
