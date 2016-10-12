<?php
use Migrations\AbstractMigration;

class MonthlyStatsUpdate extends AbstractMigration
{

    public function up()
    {

        $this->table('monthly_stats')
            ->removeColumn('cassandra_status')
            ->update();

        $this->table('monthly_stats')
            ->addColumn('cassandra_ts', 'integer', [
                'default' => null,
                'length' => 11,
                'null' => true,
                'after' => 'deployment_status',
            ])
            ->addColumn('cassandra_rec', 'integer', [
                'default' => null,
                'length' => 11,
                'null' => true,
                'after' => 'cassandra_ts',
            ])
            ->update();
    }

    public function down()
    {

        $this->table('monthly_stats')
            ->addColumn('cassandra_status', 'string', [
                'default' => null,
                'length' => 1,
                'null' => true,
                'after' => 'deployment_status',
            ])
            ->removeColumn('cassandra_ts')
            ->removeColumn('cassandra_rec')
            ->update();

    }
}

