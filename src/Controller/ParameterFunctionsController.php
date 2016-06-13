<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * ParameterFunctions Controller
 *
 * @property \App\Model\Table\ParameterFunctionsTable $ParameterFunctions
 */
class ParameterFunctionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $parameterFunctions = $this->paginate($this->ParameterFunctions);

        $this->set(compact('parameterFunctions'));
        $this->set('_serialize', ['parameterFunctions']);
    }

    /**
     * View method
     *
     * @param string|null $id Parameter Function id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $parameterFunction = $this->ParameterFunctions->get($id, [
            'contain' => ['Parameters']
        ]);

        $this->set('parameterFunction', $parameterFunction);
        $this->set('_serialize', ['parameterFunction']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function admin_add()
    {
        $parameterFunction = $this->ParameterFunctions->newEntity();
        if ($this->request->is('post')) {
            $parameterFunction = $this->ParameterFunctions->patchEntity($parameterFunction, $this->request->data);
            if ($this->ParameterFunctions->save($parameterFunction)) {
                $this->Flash->success(__('The parameter function has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The parameter function could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('parameterFunction'));
        $this->set('_serialize', ['parameterFunction']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Parameter Function id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function admin_edit($id = null)
    {
        $parameterFunction = $this->ParameterFunctions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $parameterFunction = $this->ParameterFunctions->patchEntity($parameterFunction, $this->request->data);
            if ($this->ParameterFunctions->save($parameterFunction)) {
                $this->Flash->success(__('The parameter function has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The parameter function could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('parameterFunction'));
        $this->set('_serialize', ['parameterFunction']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Parameter Function id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function admin_delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $parameterFunction = $this->ParameterFunctions->get($id);
        if ($this->ParameterFunctions->delete($parameterFunction)) {
            $this->Flash->success(__('The parameter function has been deleted.'));
        } else {
            $this->Flash->error(__('The parameter function could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
