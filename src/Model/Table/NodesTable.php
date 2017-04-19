<?php
namespace App\Model\Table;

use App\Model\Entity\Node;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Nodes Model
 *
 */
class NodesTable extends Table
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

        $this->table('nodes');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Sites', [
            'foreignKey' => 'parent_site',
            'bindingKey' => 'reference_designator'
        ]);
        $this->hasMany('Instruments', [
            'foreignKey' => 'parent_node',
            'bindingKey' => 'reference_designator'
        ]);
        $this->hasMany('Deployments', [
            'foreignKey' => 'reference_designator',
            'bindingKey' => 'reference_designator',
            'sort' => 'start_date'
        ]);
        $this->hasMany('Notes', [
            'foreignKey' => 'reference_designator',
            'bindingKey' => 'reference_designator',
            'sort' => 'start_date'
        ]);
        $this->hasMany('Annotations', [
            'foreignKey' => 'reference_designator',
            'bindingKey' => 'reference_designator',
            'sort' => 'start_datetime'
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
            ->requirePresence('reference_designator', 'create')
            ->notEmpty('reference_designator')
            ->add('reference_designator', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('region', 'create')
            ->notEmpty('region');

        $validator
            ->requirePresence('site', 'create')
            ->notEmpty('site');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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
