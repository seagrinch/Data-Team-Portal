<?php
use Migrations\AbstractMigration;

class UpdateParameters extends AbstractMigration
{

    public function up()
    {

        $this->table('parameters')
            ->addColumn('parameter_type', 'string', [
                'after' => 'data_product_type',
                'default' => null,
                'length' => 100,
                'null' => true,
            ])
            ->addColumn('value_encoding', 'string', [
                'after' => 'parameter_type',
                'default' => null,
                'length' => 100,
                'null' => true,
            ])
            ->update();
    }

    public function down()
    {

        $this->table('parameters')
            ->removeColumn('parameter_type')
            ->removeColumn('value_encoding')
            ->update();
    }
}

