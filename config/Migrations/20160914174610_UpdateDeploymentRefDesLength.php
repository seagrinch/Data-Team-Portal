<?php
use Migrations\AbstractMigration;

class UpdateDeploymentRefDesLength extends AbstractMigration
{

    public function up()
    {

        $this->table('notes')
            ->changeColumn('reference_designator', 'string', [
                'length' => 100,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('notes')
            ->changeColumn('reference_designator', 'string', [
                'default' => null,
                'length' => 30,
                'null' => true,
            ])
            ->update();
    }
}

