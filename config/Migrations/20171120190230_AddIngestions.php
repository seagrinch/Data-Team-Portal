<?php
use Migrations\AbstractMigration;

class AddIngestions extends AbstractMigration
{

    public function up()
    {

        $this->table('ingestions')
            ->addColumn('reference_designator', 'string', [
                'default' => null,
                'limit' => 27,
                'null' => true,
            ])
            ->addColumn('deployment', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('method', 'string', [
                'default' => null,
                'limit' => 25,
                'null' => true,
            ])
            ->addColumn('status', 'string', [
                'default' => null,
                'limit' => 25,
                'null' => true,
            ])
            ->addColumn('notes', 'text', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->create();
    }

    public function down()
    {

        $this->dropTable('ingestions');
    }
}

