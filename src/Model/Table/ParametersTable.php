<?php
namespace App\Model\Table;

use App\Model\Entity\Parameter;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parameters Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParameterFunctions
 * @property \Cake\ORM\Association\BelongsToMany $Streams
 */
class ParametersTable extends Table
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

        $this->table('parameters');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('ParameterFunctions', [
            'foreignKey' => 'parameter_function_id'
        ]);
        $this->belongsToMany('Streams', [
            'foreignKey' => 'parameter_id',
            'targetForeignKey' => 'stream_id',
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
            ->allowEmpty('name');

        $validator
            ->allowEmpty('unit');

        $validator
            ->allowEmpty('fill_value');

        $validator
            ->allowEmpty('display_name');

        $validator
            ->allowEmpty('standard_name');

        $validator
            ->allowEmpty('precision');

        $validator
            ->allowEmpty('parameter_function_map');

        $validator
            ->allowEmpty('data_product_identifier');

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
        $rules->add($rules->existsIn(['parameter_function_id'], 'ParameterFunctions'));
        return $rules;
    }
}
