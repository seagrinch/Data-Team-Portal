<?php
use Migrations\AbstractMigration;

class AddNewAnnotations extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {
        $this->table('annotations')
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
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('deployment', 'integer', [
                'default' => null,
                'limit' => 11,
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
            ->addColumn('parameter', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('start_datetime', 'datetime', [
                'default' => null,
                'null' => true,
            ])
            ->addColumn('end_datetime', 'datetime', [
                'default' => null,
                'null' => true,
            ])
            ->addColumn('annotation', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('status', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => true,
            ])
            ->addColumn('redmine_issue', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('todo', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('reviewed_by', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => true,
            ])
            ->addColumn('reviewed_date', 'datetime', [
                'default' => null,
                'null' => true,
            ])
            ->addColumn('uframe_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->create();
    }

    public function down()
    {
        $this->dropTable('annotations');
    }
}
