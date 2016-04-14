<?php
namespace App\Model\Table;

use App\Model\Entity\Calibration;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Calibrations Model
 *
 */
class CalibrationsTable extends Table
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

        $this->table('calibrations');
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
            ->allowEmpty('sensor_barcode');

        $validator
            ->allowEmpty('sensor_serial_number');

        $validator
            ->allowEmpty('cc_name');

        $validator
            ->allowEmpty('cc_value');

        return $validator;
    }
}
