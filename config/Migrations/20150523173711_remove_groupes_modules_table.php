<?php

use Phinx\Migration\AbstractMigration;

class RemoveGroupesModulesTable extends AbstractMigration
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
        $this->dropTable('groupes_modules');
        $table = $this->table('groupes');
        $table->addColumn('module_id', 'integer')
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $table = $this->table('groupes_modules');
        $table
            ->addColumn('groupe_id', 'integer', [
                'limit' => '11',
                'signed' => '',
                'null' => '',
                'default' => null
            ])
            ->addColumn('module_id', 'integer', [
                'limit' => '11',
                'signed' => '',
                'null' => '',
                'default' => null
            ])
            ->save();
    }
}