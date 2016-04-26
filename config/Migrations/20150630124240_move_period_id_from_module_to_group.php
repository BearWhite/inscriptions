<?php

use Phinx\Migration\AbstractMigration;

class MovePeriodIdFromModuleToGroup extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table('modules');
        $table->removeColumn('periode_id')
            ->save();

        $table = $this->table('groupes');
        $table->addColumn('periode_id', 'integer')
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}