<?php
namespace App\Model\Table;

use App\Model\Entity\Instrument;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Instruments Model
 *
 * @property \Cake\ORM\Association\HasMany $DataStreams
 */
class InstrumentsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('instruments');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Nodes', [
            'foreignKey' => 'parent_node',
            'bindingKey' => 'reference_designator'
        ]);
        $this->hasMany('DataStreams', [
            'foreignKey' => 'instrument_id'
        ]);
        $this->hasMany('Deployments', [
            'foreignKey' => 'reference_designator',
            'bindingKey' => 'reference_designator'
        ]);
        $this->hasMany('Calibrations', [
            'foreignKey' => 'reference_designator',
            'bindingKey' => 'reference_designator'
        ]);
        $this->hasMany('Notes', [
            'foreignKey' => 'reference_designator',
            'bindingKey' => 'reference_designator',
            'conditions' => ['model' => 'instruments']
        ]);
        $this->hasMany('MonthlyStats', [
            'foreignKey' => 'reference_designator',
            'bindingKey' => 'reference_designator',
        ]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('reference_designator')
            ->add('reference_designator', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('region', 'create')
            ->notEmpty('region');

        $validator
            ->requirePresence('site', 'create')
            ->notEmpty('site');

        $validator
            ->requirePresence('node', 'create')
            ->notEmpty('node');

        $validator
            ->allowEmpty('name');

        $validator
            ->add('start_depth', 'naturalNumber', ['rule' => 'naturalNumber', 'message'=>'Please specify a valid whole number'])
            ->allowEmpty('start_depth');

        $validator
            ->add('end_depth', 'naturalNumber', ['rule' => 'naturalNumber', 'message'=>'Please specify a valid whole number'])
            ->allowEmpty('end_depth');

        $validator
            ->allowEmpty('location');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['reference_designator']));
        return $rules;
    }
}
