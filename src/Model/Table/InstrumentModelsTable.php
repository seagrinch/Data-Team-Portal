<?php
namespace App\Model\Table;

use App\Model\Entity\InstrumentModel;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InstrumentModels Model
 *
 */
class InstrumentModelsTable extends Table
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

        $this->table('instrument_models');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('InstrumentClasses', [
            'foreignKey' => 'class',
            'bindingKey' => 'class'
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
            ->requirePresence('class', 'create')
            ->notEmpty('class');

        $validator
            ->requirePresence('series', 'create')
            ->notEmpty('series');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('make', 'create')
            ->notEmpty('make');

        $validator
            ->requirePresence('model', 'create')
            ->notEmpty('model');

        return $validator;
    }
}
