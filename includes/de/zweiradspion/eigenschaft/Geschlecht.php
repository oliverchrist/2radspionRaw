<?php
namespace de\zweiradspion\eigenschaft;
use de\zweiradspion\SelectEigenschaft;

/**
 * Das Rad
 *
 * @author christ
 */
class Geschlecht extends SelectEigenschaft  {
    protected $name = 'geschlecht'; 
    protected $text = array(
        '-' => 'Geschlecht',
        'Unisex' => 'Unisex',
        'Frauen' => 'Frauen',
        'Männer' => 'Männer',
        'Kinder' => 'Kinder',
        'Jugend' => 'Jugend');
}