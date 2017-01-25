<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DeploymentReviews Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\DeploymentReview get($primaryKey, $options = [])
 * @method \App\Model\Entity\DeploymentReview newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DeploymentReview[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DeploymentReview|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DeploymentReview patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DeploymentReview[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DeploymentReview findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DeploymentReviewsTable extends Table
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

        $this->table('deployment_reviews');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->requirePresence('reference_designator', 'create')
            ->notEmpty('reference_designator');

        $validator
            ->integer('deployment_number')
            ->requirePresence('deployment_number', 'create')
            ->notEmpty('deployment_number');

        $validator
            ->allowEmpty('status');

        $validator
            ->date('asset_sheet_reviewed','mdy')
            ->allowEmpty('asset_sheet_reviewed');

        $validator
            ->date('calibration_sheet_reviewed','mdy')
            ->allowEmpty('calibration_sheet_reviewed');

        $validator
            ->date('deployment_sheet_reviewed','mdy')
            ->allowEmpty('deployment_sheet_reviewed');

        $validator
            ->date('ingest_sheet_reviewed','mdy')
            ->allowEmpty('ingest_sheet_reviewed');

        $validator
            ->date('raw_data_reviewed','mdy')
            ->allowEmpty('raw_data_reviewed');

        $validator
            ->url('raw_data_url')
            ->allowEmpty('raw_data_url');

        $validator
            ->date('parameter_check','mdy')
            ->allowEmpty('parameter_check');

        $validator
            ->date('availability_check','mdy')
            ->allowEmpty('availability_check');

        $validator
            ->date('quality_check','mdy')
            ->allowEmpty('quality_check');

        $validator
            ->date('environment_check','mdy')
            ->allowEmpty('environment_check');

        $validator
            ->decimal('percent_good')
            ->allowEmpty('percent_good');

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
        $rules->add($rules->isUnique(
            ['reference_designator', 'deployment_number'],
            'This reference_designator & deployment_number combination has already been used.'
        ));
        $rules->add($rules->existsIn(['user_id'], 'Users'));        
        return $rules;
    }
}
