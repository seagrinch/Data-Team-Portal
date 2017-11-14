<?php
use Migrations\AbstractMigration;

class AddedStats extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {

        $this->table('instrument_stats')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('reference_designator', 'string', [
                'default' => null,
                'limit' => 27,
                'null' => true,
            ])
            ->addColumn('date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('status', 'integer', [
                'default' => null,
                'limit' => 2,
                'null' => true,
            ])
            ->create();

        $this->table('stream_stats')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('reference_designator', 'string', [
                'default' => null,
                'limit' => 27,
                'null' => true,
            ])
            ->addColumn('method', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('stream', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('status', 'integer', [
                'default' => null,
                'limit' => 2,
                'null' => true,
            ])
            ->create();
    }

    public function down()
    {

        $this->dropTable('instrument_stats');

        $this->dropTable('stream_stats');
    }
}

