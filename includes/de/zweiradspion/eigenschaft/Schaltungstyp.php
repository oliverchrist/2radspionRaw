<?php
namespace de\zweiradspion\eigenschaft;
use de\zweiradspion\SelectEigenschaft;

/**
 * Das Rad
 *
 * @author christ
 */
class Schaltungstyp extends SelectEigenschaft  {
    protected $name = 'schaltungstyp'; 
    protected $text = array(
        '-' => 'Schaltungstyp',
        'Kettenschaltung' => 'Kettenschaltung',
        'Nabenschaltung' => 'Nabenschaltung',
        'Kombiniert' => 'Kombiniert',
        'Tretlagerschaltung' => 'Tretlagerschaltung');
}