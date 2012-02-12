<?php
namespace de\zweiradspion\eigenschaft;
use de\zweiradspion\SelectEigenschaft;

/**
 * Das Rad
 *
 * @author christ
 */
class Einsatzbereich extends SelectEigenschaft  {
    protected $name = 'einsatzbereich'; 
    protected $text = array(
        'Einsatzbereich',
        'All Mountain',
        'Cross-Country',
        'Dirtjump',
        'Downhill',
        'Enduro',
        'Freeride',
        'Trail',
        'Straße',
        'Halfpipe');
}