<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Periode Entity.
 */
class Periode extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'public_title' => true,
        'nb_options' => true,
        'date_debut' => true,
        'date_fin' => true,
        'date_debut_choix' => true,
        'date_fin_choix' => true,
        'modules' => true,
    ];

    protected function _getFullTitle($title)
    {
        $from = date_create_from_format('d/m/Y i:s', $this->_properties['date_debut']);
        $to = date_create_from_format('d/m/Y i:s', $this->_properties['date_fin']);
        return $this->_properties['title'] . ' (du ' . date_format($from, 'd/m/Y') . ' au ' . date_format($to, 'd/m/Y') . ')';
    }

    protected function _setDateDebut($input)
    {
        $date = date_create_from_format('d/m/Y i:s', $input);
        return date_format($date, 'Y-m-d i:s');
    }

    protected function _setDateFin($input)
    {
        $date = date_create_from_format('d/m/Y i:s', $input);
        return date_format($date, 'Y-m-d i:s');
    }

    protected function _setDateDebutChoix($input)
    {
        $date = date_create_from_format('d/m/Y i:s', $input);
        return date_format($date, 'Y-m-d i:s');
    }

    protected function _setDateFinChoix($input)
    {
        $date = date_create_from_format('d/m/Y i:s', $input);
        return date_format($date, 'Y-m-d i:s');
    }
}
