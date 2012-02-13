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
        'Farbe',
        'Beige',
        'Blau',
        'Braun',
        'Creme',
        'Dunkelblau',
        'Gelb',
        'Gold',
        'Grau',
        'Grün',
        'Hellblau',
        'Lila',
        'Olive',
        'Orange',
        'Pink',
        'Rot',
        'Schwarz',
        'Silber',
        'Weiß',
        'andere');
}