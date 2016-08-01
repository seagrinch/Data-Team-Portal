<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TestItem Entity.
 *
 * @property int $id
 * @property int $test_plan_id
 * @property \App\Model\Entity\TestPlan $test_plan
 * @property int $test_question_id
 * @property \App\Model\Entity\TestQuestion $test_question
 * @property string $reference_designator
 * @property string $method
 * @property int $stream_id
 * @property \App\Model\Entity\Stream $stream
 * @property int $parameter_id
 * @property \App\Model\Entity\Parameter $parameter
 * @property int $result
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class TestItem extends Entity
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
