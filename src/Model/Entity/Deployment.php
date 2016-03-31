<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Deployment Entity.
 *
 * @property int $id
 * @property string $reference_designator
 * @property string $mooring_barcode
 * @property string $mooring_serial_number
 * @property int $deployment_number
 * @property \Cake\I18n\Time $anchor_launch_date
 * @property \Cake\I18n\Time $anchor_launch_time
 * @property \Cake\I18n\Time $recover_date
 * @property float $latitude
 * @property float $longitude
 * @property float $water_depth
 * @property string $cruise_number
 * @property string $notes
 */
class Deployment extends Entity
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
