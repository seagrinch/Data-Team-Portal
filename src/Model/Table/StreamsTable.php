<?php
namespace App\Model\Table;

use App\Model\Entity\Stream;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Streams Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Designators
 * @property \Cake\ORM\Association\BelongsToMany $Parameters
 */
class StreamsTable extends Table
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

        $this->table('streams');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('DataStreams', [
            'foreignKey' => 'stream_name',
            'bindingKey' => 'name'
        ]);
        $this->belongsToMany('Parameters', [
            'foreignKey' => 'stream_id',
            'targetForeignKey' => 'parameter_id',
            'joinTable' => 'parameters_streams'
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
            ->allowEmpty('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('time_parameter')
            ->allowEmpty('time_parameter');

        $validator
            ->boolean('uses_ctd')
            ->allowEmpty('uses_ctd');

        $validator
            ->integer('binsize_minutes')
            ->allowEmpty('binsize_minutes');

        $validator
            ->allowEmpty('stream_type');

        $validator
            ->allowEmpty('display_name');

        $validator
            ->allowEmpty('description');

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
        $rules->add($rules->isUnique(['name']));
        return $rules;
    }
}
