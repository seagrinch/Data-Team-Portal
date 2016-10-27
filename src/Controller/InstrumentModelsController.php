<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * InstrumentModels Controller
 *
 * @property \App\Model\Table\InstrumentModelsTable $InstrumentModels
 */
class InstrumentModelsController extends AppController
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
        $instrument_models = $this->paginate($this->InstrumentModels);

        $this->set(compact('instrument_models'));
        $this->set('_serialize', ['instrument_models']);
    }

    /**
     * View method
     */
    public function view($iclass = null,$iseries = null) {
      $query = $this->InstrumentModels->find()
        ->where(['InstrumentModels.class'=>$iclass,'InstrumentModels.series'=>$iseries])
        ->contain('InstrumentClasses');
      $instrument_model = $query->first();
      
      if (empty($instrument_model)) {
          throw new NotFoundException(__('Instrument Model not found'));
      }

      $this->loadModel('Instruments');
      $instruments = $this->Instruments->find('all')
        ->where(['Instruments.reference_designator LIKE' => '%' . $instrument_model->class . $instrument_model->series . '%'])
        ->contain('Nodes.Sites.Regions');

      $this->set(compact(['instrument_model','instruments']));
      $this->set('_serialize', ['instrument_model']);
    }

    /**
     * Edit method
     */
    public function edit($iclass = null,$iseries = null)
    {
      $query = $this->InstrumentModels->find()
        ->where(['InstrumentModels.class'=>$iclass,'InstrumentModels.series'=>$iseries]);
      $instrument_model = $query->first();
        
        if (empty($instrument_model)) {
            throw new NotFoundException(__('Instrument Model not found'));
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $instrument_model = $this->InstrumentModels->patchEntity($instrument_model, $this->request->data, [
                'fieldList'=>['name','description','website_info']
            ]);
            if ($this->InstrumentModels->save($instrument_model)) {
                $this->Flash->success(__('The Instrument Model has been updated.'));
                return $this->redirect(['action' => 'view', $instrument_model->class, $instrument_model->series]);
            } else {
                $this->Flash->error(__('The Instrument Model could not be updated. Please, try again.'));
            }
        }
        $this->set(compact('instrument_model'));
        $this->set('_serialize', ['instrument_model']);
    }

}
