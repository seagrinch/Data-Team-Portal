<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ParameterFunction Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $function_type
 * @property string $function
 * @property string $owner
 * @property string $description
 * @property string $qc_flag
 * @property \App\Model\Entity\Parameter[] $parameters
 */
class ParameterFunction extends Entity
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
