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
            ->notEmpty('reference_designator', 'A reference_designator is required');
        $validator
            ->allowEmpty('method');
        $validator
            ->allowEmpty('stream');
        $validator
            ->allowEmpty('parameter');
            
        $validator
            ->notEmpty('start_date');
        $validator
            ->notEmpty('end_date');
        $validator
            ->notEmpty('annotation', 'An annotation is required');
            
        $validator
            ->allowEmpty('exclusionFlag');
        $validator
            ->allowEmpty('qcFlag');
        $validator
            ->allowEmpty('source');
        
        return $validator;
    }

}
