<?php
use Phinx\Migration\AbstractMigration;

class Initial extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * @return void
     */
    public function change()
    {
        $table = $this->table('groupes');
        $table
            ->addColumn('capacite', 'integer', [
                'limit' => '11',
                'signed' => '',
                'null' => '',
                'default' => null
            ])
            ->addColumn('obligatoire', 'boolean', [
                'limit' => '',
                'null' => '',
                'default' => null
            ])
            ->save();
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
        $table = $this->table('groupes_parcours');
        $table
            ->addColumn('groupe_id', 'integer', [
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
        $table = $this->table('groupes_utilisateurs');
        $table
            ->addColumn('utilisateur_id', 'integer', [
                'limit' => '11',
                'signed' => '',
                'null' => '',
                'default' => null
            ])
            ->addColumn('groupe_id', 'integer', [
                'limit' => '11',
                'signed' => '',
                'null' => '',
                'default' => null
            ])
            ->save();
        $table = $this->table('mentions');
        $table
            ->addColumn('title', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => null
            ])
            ->save();
        $table = $this->table('modules');
        $table
            ->addColumn('title', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => null
            ])
            ->addColumn('periode_id', 'integer', [
                'limit' => '11',
                'signed' => '',
                'null' => '',
                'default' => null
            ])
            ->save();
        $table = $this->table('parcours');
        $table
            ->addColumn('title', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => null
            ])
            ->addColumn('année', 'boolean', [
                'limit' => '',
                'null' => '',
                'default' => null
            ])
            ->save();
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
        $table = $this->table('periodes');
        $table
            ->addColumn('title', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => null
            ])
            ->addColumn('date_debut', 'timestamp', [
                'limit' => '',
                'null' => '1',
                'default' => null
            ])
            ->addColumn('date_fin', 'timestamp', [
                'limit' => '',
                'null' => '1',
                'default' => null
            ])
            ->addColumn('date_debut_choix', 'timestamp', [
                'limit' => '',
                'null' => '1',
                'default' => null
            ])
            ->addColumn('date_fin_choix', 'timestamp', [
                'limit' => '',
                'null' => '1',
                'default' => null
            ])
            ->save();
        $table = $this->table('roles');
        $table
            ->addColumn('title', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => null
            ])
            ->save();
        $table = $this->table('specialites');
        $table
            ->addColumn('title', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => null
            ])
            ->addColumn('mentions_id', 'integer', [
                'limit' => '11',
                'signed' => '',
                'null' => '',
                'default' => null
            ])
            ->save();
        $table = $this->table('utilisateurs');
        $table
            ->addColumn('prenom', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => null
            ])
            ->addColumn('nom', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => null
            ])
            ->addColumn('identifiant', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => null
            ])
            ->addColumn('motdepasse', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => null
            ])
            ->addColumn('actif', 'boolean', [
                'limit' => '',
                'null' => '',
                'default' => null
            ])
            ->addColumn('email', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => null
            ])
            ->addColumn('telephone', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => null
            ])
            ->addColumn('role_id', 'integer', [
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

    /**
     * Migrate Up.
     *
     * @return void
     */
    public function up()
    {
    }

    /**
     * Migrate Down.
     *
     * @return void
     */
    public function down()
    {
    }

}
