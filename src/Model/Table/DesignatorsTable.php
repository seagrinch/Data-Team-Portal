<?php
namespace App\Model\Table;

use App\Model\Entity\Designator;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Designators Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Parent
 * @property \Cake\ORM\Association\HasMany $Child
 */
class DesignatorsTable extends Table
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

        $this->table('designators');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Parent', [
            'className' => 'Designators',
            'foreignKey' => 'parent_designator',
            'bindingKey' => 'reference_designator'
        ]);
        $this->hasMany('Child', [
            'className' => 'Designators',
            'foreignKey' => 'parent_designator',
            'bindingKey' => 'reference_designator'
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
            ->allowEmpty('reference_designator')
            ->add('reference_designator', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('designator_type');

        $validator
            ->allowEmpty('name');

        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('type');

        $validator
            ->allowEmpty('location');

        $validator
            ->decimal('start_depth')
            ->allowEmpty('start_depth');

        $validator
            ->decimal('end_depth')
            ->allowEmpty('end_depth');

        $validator
            ->numeric('latitude')
            ->allowEmpty('latitude');

        $validator
            ->numeric('longitude')
            ->allowEmpty('longitude');

        $validator
            ->allowEmpty('parent_designator');

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
        $rules->add($rules->isUnique(['reference_designator']));
        return $rules;
    }
}
