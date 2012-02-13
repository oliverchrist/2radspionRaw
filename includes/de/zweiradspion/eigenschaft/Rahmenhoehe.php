<?php
namespace de\zweiradspion\eigenschaft;
use de\zweiradspion\SelectEigenschaft;

/**
 * Das Rad
 *
 * @author christ
 */
class Rahmenhoehe extends SelectEigenschaft  {
    protected $name = 'rahmenhoehe'; 
    protected $text = array(
        'Rahmenhöhe',
        'bis 43 cm',
        '44-50 cm',
        '51-54 cm',
        '55-59 cm',
        'über 60 cm');
}