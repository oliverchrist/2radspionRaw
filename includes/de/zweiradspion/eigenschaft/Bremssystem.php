<?php
namespace de\zweiradspion\eigenschaft;
use de\zweiradspion\SelectEigenschaft;

/**
 * Das Rad
 *
 * @author christ
 */
class Bremssystem extends SelectEigenschaft  {
    protected $name = 'bremssystem'; 
    protected $text = array(
        '-' => 'Bremssystem',
        'Felgenbremse' => 'Felgenbremse',
        'Hydraulische Felgenbremse' => 'Hydraudische Felgenbremse',
        'Scheibenbremse' => 'Scheibenbremse',
        'Rollenbremse' => 'Rollenbremse',
        'Rücktritt' => 'Rücktritt',
        'Trommelbremse' => 'Trommelbremse');
}