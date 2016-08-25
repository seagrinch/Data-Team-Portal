<?php
use Migrations\AbstractMigration;

class RefactorTestRuns extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {

        $this->table('test_items')
            ->removeColumn('test_question_id')
            ->removeColumn('reference_designator')
            ->renameColumn('test_plan_id','test_run_id')
            ->renameColumn('result','status_complete')
            ->renameColumn('result_comment','comment')
            ->addColumn('status_reasonable', 'string', [
                'default' => null,
                'length' => 10,
                'null' => true,
                'after' => 'status_complete',
            ])
            ->update();

        $this->table('test_plans')
            ->rename('test_runs');

        $this->table('test_runs')
            ->addColumn('reference_designator', 'string', [
                'default' => null,
                'limit' => 27,
                'null' => true,
                'after' => 'name',
            ])
            ->addColumn('deployment', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
                'after' => 'reference_designator',
            ])
            ->update();

        $this->dropTable('test_questions');
    }

    public function down()
    {

        $this->table('test_items')
            ->addColumn('test_question_id', 'integer', [
                'default' => null,
                'length' => 11,
                'null' => true,
                'after' => 'id',
            ])
            ->addColumn('reference_designator', 'string', [
                'default' => null,
                'length' => 27,
                'null' => true,
                'after' => 'test_question_id',
            ])
            ->renameColumn('test_run_id','test_plan_id')
            ->renameColumn('status_complete','result')
            ->renameColumn('comment','result_comment')
            ->removeColumn('status_reasonable')
            ->update();

        $this->table('test_runs')
            ->rename('test_plans');

        $this->table('test_plans')
            ->removeColumn('reference_designator')
            ->removeColumn('deployment')
            ->update();

        $this->table('test_questions')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('question', 'string', [
                'default' => null,
                'limit' => 250,
                'null' => true,
            ])
            ->addColumn('type', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

    }
}

