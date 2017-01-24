<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CruiseReviews Model
 *
 * @method \App\Model\Entity\CruiseReview get($primaryKey, $options = [])
 * @method \App\Model\Entity\CruiseReview newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CruiseReview[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CruiseReview|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CruiseReview patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CruiseReview[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CruiseReview findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CruiseReviewsTable extends Table
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

        $this->table('cruise_reviews');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Cruises', [
            'foreignKey' => 'cruise_cuid',
            'bindingKey' => 'cuid',
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
            ->allowEmpty('cruise_cuid')
            ->add('cruise_cuid', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('status');

        $validator
            ->date('cruise_plan','mdy')
            ->allowEmpty('cruise_plan');

        $validator
            ->allowEmpty('cruise_plan_url');

        $validator
            ->date('quick_look','mdy')
            ->allowEmpty('quick_look');

        $validator
            ->allowEmpty('quick_look_url');

        $validator
            ->date('asset_sheet_submitted','mdy')
            ->allowEmpty('asset_sheet_submitted');

        $validator
            ->date('asset_sheet_reviewed','mdy')
            ->allowEmpty('asset_sheet_reviewed');

        $validator
            ->date('calibration_sheet_submitted','mdy')
            ->allowEmpty('calibration_sheet_submitted');

        $validator
            ->date('calibration_sheet_reviewed','mdy')
            ->allowEmpty('calibration_sheet_reviewed');

        $validator
            ->date('deployment_sheet_submitted','mdy')
            ->allowEmpty('deployment_sheet_submitted');

        $validator
            ->date('deployment_sheet_reviewed','mdy')
            ->allowEmpty('deployment_sheet_reviewed');

        $validator
            ->date('ingest_sheet_reviewed','mdy')
            ->allowEmpty('ingest_sheet_reviewed');

        $validator
            ->date('raw_data','mdy')
            ->allowEmpty('raw_data');

        $validator
            ->allowEmpty('raw_data_url');

        $validator
            ->date('live_ingestion_started','mdy')
            ->allowEmpty('live_ingestion_started');

        $validator
            ->date('cruise_report','mdy')
            ->allowEmpty('cruise_report');

        $validator
            ->allowEmpty('cruise_report_url');

        $validator
            ->date('cruise_photos','mdy')
            ->allowEmpty('cruise_photos');

        $validator
            ->allowEmpty('cruise_photos_url');

        $validator
            ->date('shipboard_data','mdy')
            ->allowEmpty('shipboard_data');

        $validator
            ->allowEmpty('shipboard_data_url');

        $validator
            ->date('water_sampling_data','mdy')
            ->allowEmpty('water_sampling_data');

        $validator
            ->allowEmpty('water_sampling_data_url');

        $validator
            ->allowEmpty('summary');

        $validator
            ->allowEmpty('notes');

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
        $rules->add($rules->isUnique(['cruise_cuid']));

        return $rules;
    }
}
