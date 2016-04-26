<?php

use Phinx\Migration\AbstractMigration;

class MoveNbOptionsFromParcoursToPeriodes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $table = $this->table('parcours');
        $table->removeColumn('nb_options')
            ->save();

        $table = $this->table('periodes');
        $table->addColumn('nb_options', 'integer')
            ->save();
    }
}
