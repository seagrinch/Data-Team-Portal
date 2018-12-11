<?php
use Migrations\AbstractMigration;

class UpdateReviews extends AbstractMigration
{

    public function up()
    {

        $this->table('reviews')
            ->removeColumn('pressure_mean')
            ->changeColumn('deploy_depth', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->update();

        $this->table('reviews')
            ->addColumn('pressure_compare', 'integer', [
                'after' => 'deploy_depth',
                'default' => null,
                'length' => 11,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('reviews')
            ->addColumn('pressure_mean', 'float', [
                'after' => 'deploy_depth',
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->changeColumn('deploy_depth', 'float', [
                'default' => null,
                'length' => null,
                'null' => true,
            ])
            ->removeColumn('pressure_compare')
            ->update();
    }
}

