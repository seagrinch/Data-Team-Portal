<?php
use Migrations\AbstractMigration;

class UframeAnnotations extends AbstractMigration
{

    public function up()
    {

        $this->table('annotations')
            ->removeColumn('deployment')
            ->removeColumn('status')
            ->removeColumn('redmine_issue')
            ->removeColumn('todo')
            ->removeColumn('reviewed_by')
            ->removeColumn('reviewed_date')
            ->removeColumn('uframe_id')
            ->update();

        $this->table('annotations')
            ->addColumn('exclusionFlag', 'boolean', [
                'after' => 'annotation',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('qcFlag', 'string', [
                'after' => 'exclusionFlag',
                'default' => null,
                'length' => 100,
                'null' => true,
            ])
            ->addColumn('source', 'string', [
                'after' => 'qcFlag',
                'default' => null,
                'length' => 100,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('annotations')
            ->addColumn('deployment', 'integer', [
                'after' => 'reference_designator',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->addColumn('status', 'string', [
                'after' => 'annotation',
                'default' => null,
                'length' => 30,
                'null' => true,
            ])
            ->addColumn('redmine_issue', 'string', [
                'after' => 'status',
                'default' => null,
                'length' => 100,
                'null' => true,
            ])
            ->addColumn('todo', 'text', [
                'after' => 'redmine_issue',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('reviewed_by', 'string', [
                'after' => 'todo',
                'default' => null,
                'length' => 30,
                'null' => true,
            ])
            ->addColumn('reviewed_date', 'datetime', [
                'after' => 'reviewed_by',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->addColumn('uframe_id', 'integer', [
                'after' => 'reviewed_date',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->removeColumn('exclusionFlag')
            ->removeColumn('qcFlag')
            ->removeColumn('source')
            ->update();
    }
}

