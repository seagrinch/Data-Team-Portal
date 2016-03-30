<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Designator Entity.
 *
 * @property int $id
 * @property string $reference_designator
 * @property string $designator_type
 * @property string $name
 * @property string $description
 * @property string $type
 * @property string $location
 * @property float $start_depth
 * @property float $end_depth
 * @property float $latitude
 * @property float $longitude
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Designator extends Entity
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
