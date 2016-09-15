<?php
use Migrations\AbstractMigration;

class AddCountsToTestRuns extends AbstractMigration
{

    public function up()
    {

        $this->table('test_runs')
            ->addColumn('count_items', 'integer', [
                'default' => null,
                'length' => 11,
                'null' => true,
                'after' => 'comment',
            ])
            ->addColumn('count_complete_good', 'integer', [
                'default' => null,
                'length' => 11,
                'null' => true,
                'after' => 'count_items',
            ])
            ->addColumn('count_complete_bad', 'integer', [
                'default' => null,
                'length' => 11,
                'null' => true,
                'after' => 'count_complete_good',
            ])
            ->addColumn('count_reasonable_good', 'integer', [
                'default' => null,
                'length' => 11,
                'null' => true,
                'after' => 'count_complete_bad',
            ])
            ->addColumn('count_reasonable_bad', 'integer', [
                'default' => null,
                'length' => 11,
                'null' => true,
                'after' => 'count_reasonable_good',
            ])
            ->update();
    }

    public function down()
    {

        $this->table('test_runs')
            ->removeColumn('count_items')
            ->removeColumn('count_complete_good')
            ->removeColumn('count_complete_bad')
            ->removeColumn('count_reasonable_good')
            ->removeColumn('count_reasonable_bad')
            ->update();
    }
}

