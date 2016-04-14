<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Calibration Entity.
 *
 * @property int $id
 * @property string $reference_designator
 * @property string $mooring_barcode
 * @property string $mooring_serial_number
 * @property int $deployment_number
 * @property string $sensor_barcode
 * @property string $sensor_serial_number
 * @property string $cc_name
 * @property string $cc_value
 */
class Calibration extends Entity
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
