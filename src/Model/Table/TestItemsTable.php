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
 * @property \Cake\ORM\Association\BelongsTo $TestRuns
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

        $this->belongsTo('TestRuns', [
            'foreignKey' => 'test_run_id'
        ]);
        $this->belongsTo('Streams', [
            'foreignKey' => 'stream_id'
        ]);
        $this->belongsTo('Parameters', [
            'foreignKey' => 'parameter_id'
        ]);

        $this->addBehavior('CounterCache', [
            'TestRuns' => [
                'count_items',
                'count_complete_good' => [
                    'conditions' => ['OR'=>[
                      ['TestItems.status_complete' => 'Pass'],
                      ['TestItems.status_complete' => 'N/A']
                    ]]
                ],
                'count_complete_bad' => [
                    'conditions' => ['TestItems.status_complete' => 'Fail']
                ],
                'count_reasonable_good' => [
                    'conditions' => ['OR'=>[
                      ['TestItems.status_reasonable' => 'Pass'],
                      ['TestItems.status_reasonable' => 'N/A'],
                      ['TestItems.status_reasonable' => 'N/R']
                    ]]
                ],
                'count_reasonable_bad' => [
                    'conditions' => ['OR'=>[
                      ['TestItems.status_reasonable' => 'Fail'],
                      ['TestItems.status_reasonable' => 'Suspect'],
                      ['TestItems.status_reasonable' => 'Software']
                    ]]
                ],
            ]
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
            ->notEmpty('test_run_id');
        $validator
            ->notEmpty('method');
        $validator
            ->notEmpty('stream_id');
        $validator
            ->notEmpty('parameter_id');

        $validator
            ->allowEmpty('status_complete');
        $validator
            ->allowEmpty('status_reasonable');
        $validator
            ->allowEmpty('comment');

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
        $rules->add($rules->existsIn(['test_run_id'], 'TestRuns'));
        $rules->add($rules->existsIn(['stream_id'], 'Streams'));
        $rules->add($rules->existsIn(['parameter_id'], 'Parameters'));
        return $rules;
    }
}
