<?php
namespace de\zweiradspion\eigenschaft;
use de\zweiradspion\SelectEigenschaft;

/**
 * Das Rad
 *
 * @author christ
 */
class Laufleistung extends SelectEigenschaft  {
    protected $name = 'laufleistung'; 
    protected $text = array(
        'Laufleistung',
        '0 - 500 km',
        '501 - 1000 km',
        '1001 - 2500 km',
        '2501 - 5000 km',
        '5001 - 7500 km',
        'ab 7501 km');
}