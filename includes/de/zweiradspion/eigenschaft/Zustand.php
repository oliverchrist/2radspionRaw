<?php
namespace de\zweiradspion\eigenschaft;
use de\zweiradspion\SelectEigenschaft;

/**
 * Das Rad
 *
 * @author christ
 */
class Zustand extends SelectEigenschaft  {
    protected $name = 'zustand'; 
    protected $text = array(
        'Zustand',
        'Neu',
        'Vorführrad',
        'Gebraucht bis 1 Jahr',
        'Gebraucht bis 2 Jahre',
        'Gebraucht bis 3 Jahre',
        'Gebraucht bis 4 Jahre',
        'Gebraucht über 5 Jahre');
}