<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CruiseReviews Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
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
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            //'joinType' => 'INNER'
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
            ->date('cruise_plan','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('cruise_plan');
        $validator
            ->date('asset_sheet_submitted','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('asset_sheet_submitted');
        $validator
            ->date('asset_sheet_reviewed','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('asset_sheet_reviewed');
        $validator
            ->date('calibration_sheet_submitted','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('calibration_sheet_submitted');
        $validator
            ->date('calibration_sheet_reviewed','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('calibration_sheet_reviewed');
        $validator
            ->date('deployment_sheet_submitted','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('deployment_sheet_submitted');
        $validator
            ->date('deployment_sheet_reviewed','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('deployment_sheet_reviewed');
        $validator
            ->date('cruise_sheet_submitted','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('cruise_sheet_submitted');
        $validator
            ->date('cruise_sheet_reviewed','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('cruise_sheet_reviewed');

        $validator
            ->date('quick_look','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('quick_look');
        $validator
            ->date('raw_data_telemetered','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('raw_data_telemetered');
        $validator
            ->date('raw_data_recovered','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('raw_data_recovered');
        $validator
            ->date('ingest_sheet_telemetered','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('ingest_sheet_telemetered');
        $validator
            ->date('ingest_sheet_recovered','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('ingest_sheet_recovered');
        $validator
            ->date('live_ingestion_started','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('live_ingestion_started');

        $validator
            ->date('cruise_report','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('cruise_report');
        $validator
            ->date('cruise_photos','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('cruise_photos');
        $validator
            ->date('shipboard_data','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('shipboard_data');
        $validator
            ->date('water_sampling_data','mdy','Please enter a date as mm/dd/yyyy')
            ->allowEmpty('water_sampling_data');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
}
