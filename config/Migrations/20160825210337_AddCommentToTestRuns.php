<?php
use Migrations\AbstractMigration;

class AddCommentToTestRuns extends AbstractMigration
{

    public function up()
    {

        $this->table('test_runs')
            ->addColumn('comment', 'text', [
                'default' => null,
                'length' => null,
                'null' => true,
                'after' => 'status',
            ])
            ->update();
    }

    public function down()
    {

        $this->table('test_runs')
            ->removeColumn('comment')
            ->update();
    }
}

