<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DataStream Entity.
 *
 * @property int $id
 * @property string $reference_designator
 * @property int $instrument_id
 * @property \App\Model\Entity\Instrument $instrument
 * @property string $method
 * @property string $stream_name
 * @property int $stream_id
 * @property \App\Model\Entity\Stream $stream
 * @property string $uframe_route
 * @property string $driver
 * @property string $parser
 * @property string $instrument_type
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class DataStream extends Entity
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
