<?php
use Migrations\AbstractMigration;

class CleanUpNotes extends AbstractMigration
{

    public function up()
    {

        $this->table('notes')
            ->removeColumn('method')
            ->removeColumn('stream')
            ->removeColumn('parameter')
            ->removeColumn('uframe_id')
            ->removeColumn('exclusion_flag')
            ->update();
    }

    public function down()
    {

        $this->table('notes')
            ->addColumn('method', 'string', [
                'after' => 'deployment',
                'default' => null,
                'length' => 100,
                'null' => true,
            ])
            ->addColumn('stream', 'string', [
                'after' => 'method',
                'default' => null,
                'length' => 100,
                'null' => true,
            ])
            ->addColumn('parameter', 'integer', [
                'after' => 'stream',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->addColumn('uframe_id', 'integer', [
                'after' => 'resolved_date',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->addColumn('exclusion_flag', 'boolean', [
                'after' => 'uframe_id',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->update();
    }
}

