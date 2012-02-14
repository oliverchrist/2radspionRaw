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
        '-' => 'Einsatzbereich',
        'All Mountain' => 'All Mountain',
        'Cross-Country' => 'Cross-Country',
        'Dirtjump' => 'Dirtjump',
        'Downhill' => 'Downhill',
        'Enduro' => 'Enduro',
        'Freeride' => 'Freeride',
        'Trail' => 'Trail',
        'Straße' => 'Straße',
        'Halfpipe' => 'Halfpipe');
}