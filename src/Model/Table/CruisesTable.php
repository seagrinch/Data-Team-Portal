<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cruises Model
 *
 * @method \App\Model\Entity\Cruise get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cruise newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cruise[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cruise|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cruise patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cruise[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cruise findOrCreate($search, callable $callback = null)
 */
class CruisesTable extends Table
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

        $this->table('cruises');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Deployments', [
            'foreignKey' => 'deploy_cuid',
            'bindingKey' => 'cuid'
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
            ->allowEmpty('cuid');

        $validator
            ->allowEmpty('ship_name');

        $validator
            ->dateTime('cruise_start_date')
            ->allowEmpty('cruise_start_date');

        $validator
            ->dateTime('cruise_end_date')
            ->allowEmpty('cruise_end_date');

        $validator
            ->allowEmpty('notes');

        return $validator;
    }
}
