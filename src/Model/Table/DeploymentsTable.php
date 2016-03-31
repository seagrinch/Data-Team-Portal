<?php
namespace App\Model\Table;

use App\Model\Entity\Deployment;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Deployments Model
 *
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
            ->allowEmpty('reference_designator');

        $validator
            ->allowEmpty('mooring_barcode');

        $validator
            ->allowEmpty('mooring_serial_number');

        $validator
            ->integer('deployment_number')
            ->allowEmpty('deployment_number');

        $validator
            ->date('anchor_launch_date')
            ->allowEmpty('anchor_launch_date');

        $validator
            ->time('anchor_launch_time')
            ->allowEmpty('anchor_launch_time');

        $validator
            ->date('recover_date')
            ->allowEmpty('recover_date');

        $validator
            ->numeric('latitude')
            ->allowEmpty('latitude');

        $validator
            ->numeric('longitude')
            ->allowEmpty('longitude');

        $validator
            ->numeric('water_depth')
            ->allowEmpty('water_depth');

        $validator
            ->allowEmpty('cruise_number');

        $validator
            ->allowEmpty('notes');

        return $validator;
    }
}
