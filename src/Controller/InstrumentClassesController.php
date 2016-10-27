<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * InstrumentClasses Controller
 *
 * @property \App\Model\Table\InstrumentClassesTable $InstrumentClasses
 */
class InstrumentClassesController extends AppController
{

    /**
     * isAuthorized method
     */
    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['edit'])) {
            return true;
        }        
        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $instrument_classes = $this->paginate($this->InstrumentClasses);

        $this->set(compact('instrument_classes'));
        $this->set('_serialize', ['instrument_classes']);
    }

    /**
     * View method
     */
    public function view($id = null) {
      $query = $this->InstrumentClasses->find()
        ->where(['class'=>$id])
        ->contain(['InstrumentModels']);
      $instrument_class = $query->first();
      
      if (empty($instrument_class)) {
          throw new NotFoundException(__('Instrument Class not found'));
      }

      $this->set(compact('instrument_class'));
      $this->set('_serialize', ['instrument_class']);
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {
        $query = $this->InstrumentClasses->find()
          ->where(['class'=>$id]);
        $instrument_class = $query->first();
        
        if (empty($instrument_class)) {
            throw new NotFoundException(__('Instrument Class not found'));
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $instrument_class = $this->InstrumentClasses->patchEntity($instrument_class, $this->request->data, [
                'fieldList'=>['name','description','website_info']
            ]);
            if ($this->InstrumentClasses->save($instrument_class)) {
                $this->Flash->success(__('The Instrument Class has been updated.'));
                return $this->redirect(['action' => 'view', $instrument_class->class]);
            } else {
                $this->Flash->error(__('The Instrument Class could not be updated. Please, try again.'));
            }
        }
        $this->set(compact('instrument_class'));
        $this->set('_serialize', ['instrument_class']);
    }

}
