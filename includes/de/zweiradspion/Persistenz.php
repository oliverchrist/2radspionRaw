<?php
namespace de\zweiradspion;

/**
 * Das Rad
 *
 * @author christ
 */
class Persistenz {
    protected $uid;
    protected $erstellt;
    protected $geaendert;

    public function getUid()       { return $this->uid; }
    public function getErstellt()  { return $this->erstellt; }
    public function getGeaendert() { return $this->geaendert; }

    public function setUid($uid)             { $this->uid       = $uid; }
    public function setErstellt($erstellt)   { $this->erstellt  = $erstellt; }
    public function setGeaendert($geaendert) { $this->geaendert = $geaendert; }
}
?>