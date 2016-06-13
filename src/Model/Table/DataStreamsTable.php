<?php
namespace App\Model\Table;

use App\Model\Entity\DataStream;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DataStreams Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Instruments
 * @property \Cake\ORM\Association\BelongsTo $Streams
 */
class DataStreamsTable extends Table
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

        $this->table('data_streams');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Instruments', [
            'foreignKey' => 'instrument_id'
        ]);
        $this->belongsTo('Streams', [
            'foreignKey' => 'stream_id'
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
            ->notEmpty('reference_designator');

        $validator
            ->requirePresence('method', 'create')
            ->notEmpty('method');

        $validator
            ->requirePresence('stream_name', 'create')
            ->notEmpty('stream_name');

        $validator
            ->allowEmpty('uframe_route');

        $validator
            ->allowEmpty('driver');

        $validator
            ->allowEmpty('parser');

        $validator
            ->allowEmpty('instrument_type');

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
        $rules->add($rules->existsIn(['instrument_id'], 'Instruments'));
        $rules->add($rules->existsIn(['stream_id'], 'Streams'));
        return $rules;
    }
}
