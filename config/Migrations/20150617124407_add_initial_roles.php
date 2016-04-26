<?php

use Phinx\Migration\AbstractMigration;

class AddInitialRoles extends AbstractMigration
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
        $res = $this->query('SELECT * FROM roles WHERE title = "Etudiant"');

        if($res->rowCount() !== 1){
            $this->execute('INSERT INTO roles(title) VALUES("Etudiant")');
        }

        $res = $this->query('SELECT * FROM roles WHERE title = "Administrateur"');

        if($res->rowCount() !== 1){
            $this->execute('INSERT INTO roles(title) VALUES("Administrateur")');
        }

        $res = $this->query('SELECT * FROM roles WHERE title = "Professeur"');

        if($res->rowCount() !== 1){
            $this->execute('INSERT INTO roles(title) VALUES("Professeur")');
        }
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}