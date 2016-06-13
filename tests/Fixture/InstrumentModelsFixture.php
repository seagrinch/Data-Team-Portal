<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InstrumentModelsFixture
 *
 */
class InstrumentModelsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'class' => ['type' => 'string', 'length' => 5, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'series' => ['type' => 'string', 'length' => 2, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'name' => ['type' => 'string', 'length' => 75, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'make' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'model' => ['type' => 'string', 'length' => 75, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'class_series' => ['type' => 'unique', 'columns' => ['class', 'series'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'class' => 'Lor',
            'series' => '',
            'name' => 'Lorem ipsum dolor sit amet',
            'make' => 'Lorem ipsum dolor sit amet',
            'model' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-06-10 16:23:22',
            'modified' => '2016-06-10 16:23:22'
        ],
    ];
}
