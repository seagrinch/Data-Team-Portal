<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Deployments Model
 *
 * @method \App\Model\Entity\Deployment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Deployment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Deployment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Deployment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Deployment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Deployment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Deployment findOrCreate($search, callable $callback = null)
 */
class DeploymentsTable extends Table
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

        $this->table('deployments');
        $this->displayField('id');
        $this->primaryKey('id');
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
            ->allowEmpty('deploy_cuid');

        $validator
            ->allowEmpty('deployed_by');

        $validator
            ->allowEmpty('recover_cuid');

        $validator
            ->allowEmpty('recovered_by');

        $validator
            ->allowEmpty('reference_designator');

        $validator
            ->integer('deployment_number')
            ->allowEmpty('deployment_number');

        $validator
            ->allowEmpty('version_number');

        $validator
            ->dateTime('start_date')
            ->allowEmpty('start_date');

        $validator
            ->dateTime('stop_date')
            ->allowEmpty('stop_date');

        $validator
            ->allowEmpty('mooring_uid');

        $validator
            ->allowEmpty('node_uid');

        $validator
            ->allowEmpty('sensor_uid');

        $validator
            ->numeric('latitude')
            ->allowEmpty('latitude');

        $validator
            ->numeric('longitude')
            ->allowEmpty('longitude');

        $validator
            ->allowEmpty('orbit');

        $validator
            ->numeric('deployment_depth')
            ->allowEmpty('deployment_depth');

        $validator
            ->numeric('water_depth')
            ->allowEmpty('water_depth');

        $validator
            ->allowEmpty('notes');

        return $validator;
    }
}
