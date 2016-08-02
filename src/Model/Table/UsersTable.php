<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('username');
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
            ->notEmpty('username', 'A username is required')
            ->add('username', 'alphaNumeric', [
                'rule'=>'alphaNumeric', 
                'message'=>'Usernames can contain only letters and numbers'
            ])
            ->add('username', 'length', [
                'rule'=>['lengthBetween', 4, 20], 
                'message'=>'Usernames should be between 4 and 20 characters'
            ])
            ->add('username', 'unique', [
                'rule' => 'validateUnique', 
                'provider' => 'table', 
                'message'=>'This username is already in use'
            ]);

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password', 'A password is required')
            ->add('password', 'compare', [
                'rule'=>['compareWith', 'password_confirm'], 
                'message'=>'Passwords do not match'
            ])
            ->add('password', 'length', [
                'rule'=>['lengthBetween', 6, 20], 
                'message'=>'Passwords should be between 6 and 20 characters'
            ]);

        $validator
            ->notEmpty('email', 'An email address is required')
            ->add('email', 'email', [
                'rule'=>'email', 
                'message'=>'Please enter a valid email address'
            ])
            ->add('email', 'unique', [
                'rule' => 'validateUnique', 
                'provider' => 'table', 
                'message'=>'This email is already in use'
            ]);

        $validator
            ->notEmpty('first_name', 'Please enter a first name');

        $validator
            ->notEmpty('last_name', 'Please enter a last name');

        $validator
            ->notEmpty('role', 'A role is required')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'data', 'marine']],
                'message' => 'Please enter a valid role'
            ]);

        $validator
            ->allowEmpty('token');
            
        $validator
            ->add('token_expires', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('token_expires');
            
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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }
}
