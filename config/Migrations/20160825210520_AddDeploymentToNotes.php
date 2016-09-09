<?php
use Migrations\AbstractMigration;

class AddDeploymentToNotes extends AbstractMigration
{

    public function up()
    {
        $this->table('notes')
            ->addColumn('deployment', 'integer', [
                'default' => null,
                'length' => 11,
                'null' => true,
                'after' => 'reference_designator',
            ])
            ->update();
    }

    public function down()
    {
        $this->table('notes')
            ->removeColumn('deployment')
            ->update();
    }
}

