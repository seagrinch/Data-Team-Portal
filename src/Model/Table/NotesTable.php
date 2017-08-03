<?php
namespace App\Model\Table;

use App\Model\Entity\Annotation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Notes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class NotesTable extends Table
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

        $this->table('notes');
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
            ->allowEmpty('type');

        $validator
            ->notEmpty('comment', 'A comment is required');

        $validator
            ->notEmpty('status', 'A status is required');

        $validator
            ->notEmpty('model', 'A model is required');

        $validator
            ->notEmpty('reference_designator', 'A reference_designator is required');

        $validator
            ->allowEmpty('deployment');

        $validator
            ->allowEmpty('asset_uid');

        $validator
            ->allowEmpty('start_date')
            ->date('start_date','mdy');

        $validator
            ->allowEmpty('end_date')
            ->date('end_date','mdy');

        $validator
            ->allowEmpty('redmine_issue')
            ->integer('redmine_issue','Please enter just the Redmine issue #');

        $validator
            ->allowEmpty('resolved_date')
            ->date('resolved_date','mdy');

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
