<?php
namespace de\zweiradspion\eigenschaft;
use de\zweiradspion\SelectEigenschaft;

/**
 * Das Rad
 *
 * @author christ
 */
class Rahmenmaterial extends SelectEigenschaft  {
    protected $name = 'rahmenmaterial'; 
    protected $text = array(
        'Rahmenmaterial',
        'Aluminium',
        'Karbon',
        'Stahl',
        'Titan');
}