<?php
namespace de\zweiradspion\eigenschaft;
use de\zweiradspion\SelectEigenschaft;

/**
 * Das Rad
 *
 * @author christ
 */
class Radgroesse extends SelectEigenschaft  {
    protected $name = 'radgroesse'; 
    protected $text = array(
        'Radgröße',
        '12 Zoll',
        '14 Zoll',
        '16 Zoll',
        '20 zoll',
        '24 Zoll',
        '26 Zoll',
        '28 Zoll',
        '29 Zoll');
}