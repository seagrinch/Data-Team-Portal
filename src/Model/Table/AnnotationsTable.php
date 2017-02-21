<?php
namespace App\Model\Table;

use App\Model\Entity\Annotation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Annotation Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class AnnotationsTable extends Table
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

        $this->table('annotations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->notEmpty('user_id', 'A user_id is required');

        $validator
            ->notEmpty('comment', 'A comment is required');

        $validator
            ->notEmpty('type', 'A type is required')
            ->add('type', 'inList', [
              'rule' => ['inList', ['note','issue','annotation']],
              'message' => 'Not a valid annotation type',
              ]);

        $validator
            ->notEmpty('model', 'A model is required');

        $validator
            ->notEmpty('reference_designator', 'A reference_designator is required');

        $validator
            ->allowEmpty('deployment');
        $validator
            ->allowEmpty('stream');
        $validator
            ->allowEmpty('method');
        $validator
            ->integer('parameter','Please enter just a Parameter ID')
            ->allowEmpty('parameter');

        $validator
            ->allowEmpty('start_date')
            ->date('start_date','mdy');
        
        $validator
            ->allowEmpty('end_date')
            ->date('end_date','mdy');

        $validator
            ->integer('redmine_issue','Please enter just the Redmine issue #')
            ->allowEmpty('redmine_issue');

        $validator
            ->allowEmpty('resolved_date')
            ->date('resolved_date','mdy');

        $validator
            ->integer('uframe_id','Must be an integer')
            ->allowEmpty('uframe_id');

        $validator
            ->boolean('exclusion_flag','Must be boolean')
            ->allowEmpty('exclusion_flag');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

    /**
     * isOwnedBy function.
     */
    public function isOwnedBy($id, $userId)
    {
        return $this->exists(['id' => $id, 'user_id' => $userId]);
    }

}
