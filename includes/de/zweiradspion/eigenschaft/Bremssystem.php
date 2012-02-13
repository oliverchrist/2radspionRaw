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
        'Bremssystem',
        'Felgenbremse',
        'Hydraudische Felgenbremse',
        'Scheibenbremse',
        'Hydraudische Felgenbremse',
        'Rollenbremse',
        'Rücktritt',
        'Trommelbremse');
}