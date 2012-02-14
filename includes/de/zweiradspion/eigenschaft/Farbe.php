<?php
namespace de\zweiradspion\eigenschaft;
use de\zweiradspion\SelectEigenschaft;

/**
 * Das Rad
 *
 * @author christ
 */
class Farbe extends SelectEigenschaft  {
    protected $name = 'farbe'; 
    protected $text = array(
        '-' => 'Farbe',
        'Beige' => 'Beige',
        'Blau' => 'Blau',
        'Braun' => 'Braun',
        'Creme' => 'Creme',
        'Dunkelblau' => 'Dunkelblau',
        'Gelb' => 'Gelb',
        'Gold' => 'Gold',
        'Grau' => 'Grau',
        'Grün' => 'Grün',
        'Hellblau' => 'Hellblau',
        'Lila' => 'Lila',
        'Olive' => 'Olive',
        'Orange' => 'Orange',
        'Pink' => 'Pink',
        'Rot' => 'Rot',
        'Schwarz' => 'Schwarz',
        'Silber' => 'Silber',
        'Weiß' => 'Weiß');
}