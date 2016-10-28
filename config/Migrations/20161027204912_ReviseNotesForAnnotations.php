<?php
use Migrations\AbstractMigration;

class ReviseNotesForAnnotations extends AbstractMigration
{

    public function up()
    {

        $this->table('notes')
            ->removeColumn('resolved_comment')
            ->update();

        $this->table('notes')
            ->addColumn('method', 'string', [
                'default' => null,
                'length' => 100,
                'null' => true,
                'after' => 'deployment',
            ])
            ->addColumn('stream', 'string', [
                'default' => null,
                'length' => 100,
                'null' => true,
                'after' => 'method',
            ])
            ->addColumn('parameter', 'integer', [
                'default' => null,
                'length' => 11,
                'null' => true,
                'after' => 'stream',
            ])
            ->addColumn('uframe_id', 'integer', [
                'default' => null,
                'length' => 11,
                'null' => true,
                'after' => 'resolved_date',
            ])
            ->addColumn('exclusion_flag', 'boolean', [
                'default' => null,
                'length' => 1,
                'null' => true,
                'after' => 'uframe_id',
            ])
            ->update();
    }

    public function down()
    {

        $this->table('notes')
            ->addColumn('resolved_comment', 'text', [
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->removeColumn('method')
            ->removeColumn('stream')
            ->removeColumn('parameter')
            ->removeColumn('uframe_id')
            ->removeColumn('exclusion_flag')
            ->update();
    }
}

