<?php
use Migrations\AbstractMigration;

class MoveAnnotations extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {
       $this->table('annotations')
        ->rename('notes');
    }

    public function down()
    {
       $this->table('notes')
        ->rename('annotations');
    }
}
