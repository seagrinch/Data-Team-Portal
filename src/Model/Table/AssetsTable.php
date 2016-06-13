<?php
namespace App\Model\Table;

use App\Model\Entity\Asset;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Assets Model
 *
 */
class AssetsTable extends Table
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

        $this->table('assets');
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
            ->allowEmpty('ooi_barcode')
            ->add('ooi_barcode', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('description_of_equipment');

        $validator
            ->numeric('quant')
            ->allowEmpty('quant');

        $validator
            ->allowEmpty('manufacturer');

        $validator
            ->allowEmpty('model');

        $validator
            ->allowEmpty('manufacturer_serial_no');

        $validator
            ->allowEmpty('firmware_version');

        $validator
            ->allowEmpty('source_of_the_equipment');

        $validator
            ->allowEmpty('whether_title');

        $validator
            ->allowEmpty('location');

        $validator
            ->allowEmpty('room_number');

        $validator
            ->allowEmpty('condition');

        $validator
            ->allowEmpty('acquisition_date');

        $validator
            ->allowEmpty('original_cost');

        $validator
            ->allowEmpty('federal_participation');

        $validator
            ->allowEmpty('comments');

        $validator
            ->allowEmpty('primary_tag_date');

        $validator
            ->allowEmpty('primary_tag_organization');

        $validator
            ->allowEmpty('primary_institute_asset_tag');

        $validator
            ->allowEmpty('secondary_tag_date');

        $validator
            ->allowEmpty('second_tag_organization');

        $validator
            ->allowEmpty('institute_asset_tag');

        $validator
            ->allowEmpty('doi_tag_date');

        $validator
            ->allowEmpty('doi_tag_organization');

        $validator
            ->allowEmpty('doi_institute_asset_tag');

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
        $rules->add($rules->isUnique(['ooi_barcode']));
        return $rules;
    }
}
