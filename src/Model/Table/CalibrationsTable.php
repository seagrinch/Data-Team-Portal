<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Calibrations Model
 *
 * @method \App\Model\Entity\Calibration get($primaryKey, $options = [])
 * @method \App\Model\Entity\Calibration newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Calibration[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Calibration|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Calibration patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Calibration[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Calibration findOrCreate($search, callable $callback = null)
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
            ->allowEmpty('class');

        $validator
            ->allowEmpty('asset_uid');

        $validator
            ->date('start_date')
            ->allowEmpty('start_date');

        $validator
            ->allowEmpty('serial');

        $validator
            ->allowEmpty('name');

        $validator
            ->allowEmpty('value');

        $validator
            ->allowEmpty('notes');

        return $validator;
    }
}
