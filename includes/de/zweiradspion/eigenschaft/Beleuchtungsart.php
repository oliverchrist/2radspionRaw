<?php
namespace de\zweiradspion\eigenschaft;
use de\zweiradspion\SelectEigenschaft;

/**
 * Das Rad
 *
 * @author christ
 */
class Beleuchtungsart extends SelectEigenschaft  {
    protected $name = 'beleuchtungsart'; 
    protected $text = array(
        'Beleuchtungsart',
        'Akku',
        'Dynamo',
        'Narbendynamo');
}