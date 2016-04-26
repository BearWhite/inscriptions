<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class SyntheseNavForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('mentions', 'select')
        	//->addField('specialites', 'select')
            ;
    }
}
