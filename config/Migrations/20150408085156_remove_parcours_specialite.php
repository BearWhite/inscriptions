<?php

use Phinx\Migration\AbstractMigration;

class RemoveParcoursSpecialite extends AbstractMigration
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
        $this->dropTable('parcours_specialites');
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $table = $this->table('parcours_specialites');
        $table
            ->addColumn('specialites_id', 'integer', [
                'limit' => '11',
                'signed' => '',
                'null' => '',
                'default' => null
            ])
            ->addColumn('parcour_id', 'integer', [
                'limit' => '11',
                'signed' => '',
                'null' => '',
                'default' => null
            ])
            ->save();
    }
}