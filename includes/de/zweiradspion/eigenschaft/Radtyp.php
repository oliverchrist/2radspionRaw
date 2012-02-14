<?php
namespace de\zweiradspion\eigenschaft;
use de\zweiradspion\SelectEigenschaft;

/**
 * Das Rad
 *
 * @author christ
 */
class Radtyp extends SelectEigenschaft  {
    protected $name = 'radtyp'; 
    protected $text = array(
        '-' => 'Radtyp',
        'Beachcruiser' => 'Beachcruiser',
        'Biker Cross' => 'Biker Cross',
        'BMX' => 'BMX',
        'Cityrad' => 'Cityrad',
        'Crossrad hardtail' => 'Crossrad hardtail',
        'Crossrad vollgefedert' => 'Crossrad vollgefedert',
        'Cruiser' => 'Cruiser',
        'Einrad' => 'Einrad',
        'Elektrofahrrad' => 'Elektrofahrrad',
        'Faltrad- & Klapprad' => 'Faltrad- & Klapprad',
        'Fitnessbike' => 'Fitnessbike',
        'Freizeitrad' => 'Freizeitrad',
        'Hollandrad' => 'Hollandrad',
        'Laufrad' => 'Laufrad',
        'Mountainbike hardtail' => 'Mountainbike hardtail',
        'Mountainbike vollgefedert' => 'Mountainbike vollgefedert',
        'Pedelec' => 'Pedelec',
        'Rennrad' => 'Rennrad',
        'Dreirad' => 'Dreirad',
        'Tandem' => 'Tandem',
        'Tourenrad' => 'Tourenrad',
        'Trekkingrad' => 'Trekkingrad');
}