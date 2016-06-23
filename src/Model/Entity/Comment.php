<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comment Entity.
 *
 * @property int $id
 * @property \App\Model\Entity\Model $model
 * @property int $model_id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $body
 * @property string $type
 * @property string $reference_designator
 * @property string $redmine_issue
 * @property \Cake\I18n\Time $resolved
 * @property string $resolved_comment
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Comment extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
