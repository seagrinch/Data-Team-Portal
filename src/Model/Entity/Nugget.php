<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Nugget Entity
 *
 * @property int $id
 * @property string $title
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property string $instruments
 * @property string $description
 * @property string $location
 * @property string $graph_link
 * @property string $science_theme
 * @property string $science_concept
 * @property string $nextgen
 * @property string $difficulty
 * @property string $notebook_link
 * @property string $data_link
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Nugget extends Entity
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
        'title' => true,
        'start_date' => true,
        'end_date' => true,
        'instruments' => true,
        'description' => true,
        'location' => true,
        'graph_link' => true,
        'science_theme' => true,
        'science_concept' => true,
        'nextgen' => true,
        'difficulty' => true,
        'notebook_link' => true,
        'data_link' => true,
        'status' => true,
        'created' => true,
        'modified' => true
    ];
}
