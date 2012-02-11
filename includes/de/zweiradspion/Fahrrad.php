<?php
namespace de\zweiradspion;
use de\zweiradspion\Bild,
    de\zweiradspion\DatabaseHelper;

/**
 * Das Rad
 *
 * @author christ
 */
class Fahrrad extends Persistenz {
    
    protected $pid;
    protected $radtyp;
    protected $geschlecht;
    protected $zustand;
    protected $laufleistung;
    protected $radgroeße;
    protected $rahmenhoehe;
    protected $marke;
    protected $modell;
    protected $farbe;
    protected $bremssystem;
    protected $schaltungstyp;
    protected $rahmenmaterial;
    protected $beleuchtungsart;
    protected $einsatzbereich;
    protected $preis;
    protected $bilder;


    public function loadFromDatabase($uid) {
	$dbObject = new DatabaseHelper();
        $this->uid = \mysql_real_escape_string($uid);
        
        # hole Fahrrad Daten aus DB
        $sql = "select * from bike where uid=" . $this->uid;
        $result = mysql_query($sql);
        $row = mysql_fetch_assoc($result);
        foreach($row as $key => $val){
            $setterFunction = 'set' . $key;
            $this->$setterFunction($val);
        }
        
        # hole Bilddaten aus DB
        $sql = "select * from images where pid=" . $this->uid;
        $result = mysql_query($sql);
        while ($row = mysql_fetch_assoc($result)) {
            $this->bilder[] = new Bild($row['name'], $row['extension']);
        }
    }
        
    public function getPid(){ return $this->pid; }
    public function getRadtyp(){ return $this->radtyp; }
    public function getGeschlecht(){ return $this->geschlecht; }
    public function getZustand(){ return $this->zustand; }
    public function getLaufleistung(){ return $this->laufleistung; }
    public function getRadgroeße(){ return $this->radgroeße; }
    public function getRahmenhoehe(){ return $this->rahmenhoehe; }
    public function getMarke(){ return $this->marke; }
    public function getModell(){ return $this->modell; }
    public function getFarbe(){ return $this->farbe; }
    public function getBremssystem(){ return $this->bremssystem; }
    public function getSchaltungstyp(){ return $this->schaltungstyp; }
    public function getRahmenmaterial(){ return $this->rahmenmaterial; }
    public function getBeleuchtungsart(){ return $this->beleuchtungsart; }
    public function getEinsatzbereich(){ return $this->einsatzbereich; }
    public function getPreis(){ return $this->preis; }
    public function getBilder(){ return $this->bilder; }


    public function setPid($pid){ $this->pid = $pid; }
    public function setRadtyp($radtyp){ $this->radtyp = $radtyp; }
    public function setGeschlecht($geschlecht){ $this->geschlecht = $geschlecht; }
    public function setZustand($zustand){ $this->zustand = $zustand; }
    public function setLaufleistung($laufleistung){ $this->laufleistung = $laufleistung; }
    public function setRadgroesse($radgroesse){ $this->radgroeße = $radgroesse; }
    public function setRahmenhoehe($rahmenhoehe){ $this->rahmenhoehe = $rahmenhoehe; }
    public function setMarke($marke){ $this->marke = $marke; }
    public function setModell($modell){ $this->modell = $modell; }
    public function setFarbe($farbe){ $this->farbe = $farbe; }
    public function setBremssystem($bremssystem){ $this->bremssystem = $bremssystem; }
    public function setSchaltungstyp($schaltungstyp){ $this->schaltungstyp = $schaltungstyp; }
    public function setRahmenmaterial($rahmenmaterial){ $this->rahmenmaterial = $rahmenmaterial; }
    public function setBeleuchtungsart($beleuchtungsart){ $this->beleuchtungsart = $beleuchtungsart; }
    public function setEinsatzbereich($einsatzbereich){ $this->einsatzbereich = $einsatzbereich; }
    public function setPreis($preis){ $this->preis = $preis; }
    public function setBilder(Bild $bilder){ $this->preis = $bilder; }
}
?>