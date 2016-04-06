<?php
namespace App\Model\Table;

use App\Model\Entity\ParameterFunction;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ParameterFunctions Model
 *
 * @property \Cake\ORM\Association\HasMany $Parameters
 */
class ParameterFunctionsTable extends Table
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

        $this->table('parameter_functions');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Parameters', [
            'foreignKey' => 'parameter_function_id'
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
            ->allowEmpty('function_type');

        $validator
            ->allowEmpty('function');

        $validator
            ->allowEmpty('owner');

        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('qc_flag');

        return $validator;
    }
}
