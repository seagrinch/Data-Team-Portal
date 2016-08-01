<?php
namespace App\Model\Table;

use App\Model\Entity\TestItem;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TestItems Model
 *
 * @property \Cake\ORM\Association\BelongsTo $TestPlans
 * @property \Cake\ORM\Association\BelongsTo $TestQuestions
 * @property \Cake\ORM\Association\BelongsTo $Streams
 * @property \Cake\ORM\Association\BelongsTo $Parameters
 */
class TestItemsTable extends Table
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

        $this->table('test_items');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('TestPlans', [
            'foreignKey' => 'test_plan_id'
        ]);
        $this->belongsTo('TestQuestions', [
            'foreignKey' => 'test_question_id'
        ]);
        $this->belongsTo('Streams', [
            'foreignKey' => 'stream_id'
        ]);
        $this->belongsTo('Parameters', [
            'foreignKey' => 'parameter_id'
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
            ->notEmpty('reference_designator');

        $validator
            ->allowEmpty('result');

        $validator
            ->allowEmpty('result_comment');

        $validator
            ->integer('redmine_issue','Please enter just the Redmine issue #')
            ->allowEmpty('redmine_issue');

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
        $rules->add($rules->existsIn(['test_plan_id'], 'TestPlans'));
        $rules->add($rules->existsIn(['test_question_id'], 'TestQuestions'));
        $rules->add($rules->existsIn(['stream_id'], 'Streams'));
        $rules->add($rules->existsIn(['parameter_id'], 'Parameters'));
        return $rules;
    }
}
