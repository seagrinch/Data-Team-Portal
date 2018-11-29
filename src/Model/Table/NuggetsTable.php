<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Nuggets Model
 *
 * @method \App\Model\Entity\Nugget get($primaryKey, $options = [])
 * @method \App\Model\Entity\Nugget newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Nugget[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Nugget|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Nugget patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Nugget[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Nugget findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NuggetsTable extends Table
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

        $this->setTable('nuggets');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

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
            ->scalar('title')
            ->maxLength('title', 250)
            ->minLength('title', 5)
            ->notEmpty('title');

        $validator
            ->date('start_date','mdy')
            ->allowEmpty('start_date');

        $validator
            ->date('end_date','mdy')
            ->allowEmpty('end_date');

        $validator
            ->scalar('instruments')
            ->allowEmpty('instruments');

        $validator
            ->scalar('description')
            ->allowEmpty('description');

        $validator
            ->scalar('location')
            ->maxLength('location', 250)
            ->allowEmpty('location');

        $validator
            ->scalar('graph_link')
            ->maxLength('graph_link', 250)
            ->allowEmpty('graph_link');

        $validator
            ->scalar('science_theme')
            ->maxLength('science_theme', 250)
            ->allowEmpty('science_theme');

        $validator
            ->scalar('science_concept')
            ->maxLength('science_concept', 250)
            ->allowEmpty('science_concept');

        $validator
            ->scalar('nextgen')
            ->maxLength('nextgen', 250)
            ->allowEmpty('nextgen');

        $validator
            ->scalar('difficulty')
            ->maxLength('difficulty', 250)
            ->allowEmpty('difficulty');

        $validator
            ->scalar('notebook_link')
            ->maxLength('notebook_link', 250)
            ->allowEmpty('notebook_link');

        $validator
            ->scalar('data_link')
            ->maxLength('data_link', 250)
            ->allowEmpty('data_link');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->allowEmpty('status');

        return $validator;
    }
}
