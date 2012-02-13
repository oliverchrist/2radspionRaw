<?php
namespace de\zweiradspion;
use de\zweiradspion\Bild,
    de\zweiradspion\DatabaseHelper,
    de\zweiradspion\eigenschaft\Radtyp,
    de\zweiradspion\eigenschaft\Geschlecht,
    de\zweiradspion\eigenschaft\Zustand,
    de\zweiradspion\eigenschaft\Laufleistung,
    de\zweiradspion\eigenschaft\Radgroesse,
    de\zweiradspion\eigenschaft\Rahmenhoehe,
    de\zweiradspion\eigenschaft\Marke,
    de\zweiradspion\eigenschaft\Farbe,
    de\zweiradspion\eigenschaft\Bremssystem,
    de\zweiradspion\eigenschaft\Schaltungstyp,
    de\zweiradspion\eigenschaft\Rahmenmaterial,
    de\zweiradspion\eigenschaft\Beleuchtungsart,
    de\zweiradspion\eigenschaft\Einsatzbereich;

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
    protected $radgroesse;
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

    public function __construct($uid = NULL){
        $this->bilder = array();
        if(isset($uid)){
            $this->loadFromDatabase($uid);
        }else{
            $this->radtyp = new Radtyp();
            $this->geschlecht = new Geschlecht();
            $this->zustand = new Zustand();
            $this->laufleistung = new Laufleistung();
            $this->radgroesse = new Radgroesse();
            $this->rahmenhoehe = new Rahmenhoehe();
            $this->marke = new Marke();
            $this->farbe = new Farbe();
            $this->bremssystem = new Bremssystem();
            $this->schaltungstyp = new Schaltungstyp();
            $this->rahmenmaterial = new Rahmenmaterial();
            $this->beleuchtungsart = new Beleuchtungsart();
            $this->einsatzbereich = new Einsatzbereich();
        }
    }

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
    
    public function updateInDatabase(){
        $dbObject = new DatabaseHelper();
        $sql = 'UPDATE bike SET '
            . 'modell="' . mysql_real_escape_string(trim($this->modell)) . '", '
            . 'preis="' . mysql_real_escape_string(trim($this->preis)) . '", '
            . 'radtyp="' . mysql_real_escape_string(trim($this->radtyp->getValue())) . '", '
            . 'geschlecht="' . mysql_real_escape_string(trim($this->geschlecht->getValue())) . '", '
            . 'zustand="' . mysql_real_escape_string(trim($this->zustand->getValue())) . '", '
            . 'laufleistung="' . mysql_real_escape_string(trim($this->laufleistung->getValue())) . '", '
            . 'radgroesse="' . mysql_real_escape_string(trim($this->radgroesse->getValue())) . '", '
            . 'rahmenhoehe="' . mysql_real_escape_string(trim($this->rahmenhoehe->getValue())) . '", '
            . 'marke="' . mysql_real_escape_string(trim($this->marke->getValue())) . '", '
            . 'modell="' . mysql_real_escape_string(trim($this->modell->getValue())) . '", '
            . 'farbe="' . mysql_real_escape_string(trim($this->farbe->getValue())) . '", '
            . 'bremssystem="' . mysql_real_escape_string(trim($this->bremssystem->getValue())) . '", '
            . 'schaltungstyp="' . mysql_real_escape_string(trim($this->schaltungstyp->getValue())) . '", '
            . 'rahmenmaterial="' . mysql_real_escape_string(trim($this->rahmenmaterial->getValue())) . '", '
            . 'beleuchtungsart="' . mysql_real_escape_string(trim($this->beleuchtungsart->getValue())) . '", '
            . 'einsatzbereich="' . mysql_real_escape_string(trim($this->einsatzbereich->getValue())) . '", '   
            . 'geaendert=CURRENT_TIMESTAMP '         
            . 'WHERE uid=' . mysql_real_escape_string(trim($this->uid));
        #echo $sql;
        $result = mysql_query($sql);
        if(!$result){
            throw new \Exception('Fahrrad konnte nicht in der Datenbank bike upgedated werden');
        }
    }
    
    public function insertInDatabase(){
        $dbObject = new DatabaseHelper();
        $sql = 'INSERT INTO bike (pid, modell, preis, radtyp, geschlecht, zustand, laufleistung, radgroesse, rahmenhoehe, marke, modell, farbe, bremssystem, schaltungstyp, rahmenmaterial, beleuchtungsart, einsatzbereich, erstellt, geaendert) VALUES ('
            . $_SESSION['uid'] . ', '
            . '"' . mysql_real_escape_string(trim($this->modell)) . '", '
            . mysql_real_escape_string(trim($this->preis)) . ', '
            . mysql_real_escape_string(trim($this->radtyp->getValue())) . ', '
            . mysql_real_escape_string(trim($this->geschlecht->getValue())) . ', '
            . mysql_real_escape_string(trim($this->zustand->getValue())) . ', '
            . mysql_real_escape_string(trim($this->laufleistung->getValue())) . ', '
            . mysql_real_escape_string(trim($this->radgroesse->getValue())) . ', '
            . mysql_real_escape_string(trim($this->rahmenhoehe->getValue())) . ', '
            . mysql_real_escape_string(trim($this->marke->getValue())) . ', '
            . mysql_real_escape_string(trim($this->modell->getValue())) . ', '
            . mysql_real_escape_string(trim($this->farbe->getValue())) . ', '
            . mysql_real_escape_string(trim($this->bremssystem->getValue())) . ', '
            . mysql_real_escape_string(trim($this->schaltungstyp->getValue())) . ', '
            . mysql_real_escape_string(trim($this->rahmenmaterial->getValue())) . ', '
            . mysql_real_escape_string(trim($this->beleuchtungsart->getValue())) . ', '
            . mysql_real_escape_string(trim($this->einsatzbereich->getValue())) . ', '   
            . ' CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)';
        $result = mysql_query($sql);
        if(!$result){
            $exceptionText = 'Fahrrad konnte nicht in die Datenbank bike geschrieben werden<br>';
            if(DEBUG){
                $exceptionText .= $sql . '<br>';
            }
            throw new \Exception($exceptionText);
        }        
    }
        
    public function getPid(){ return $this->pid; }
    public function getRadtyp(){ return $this->radtyp; }
    public function getGeschlecht(){ return $this->geschlecht; }
    public function getZustand(){ return $this->zustand; }
    public function getLaufleistung(){ return $this->laufleistung; }
    public function getRadgroesse(){ return $this->radgroesse; }
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
    public function setRadtyp($radtyp){ $this->radtyp = new Radtyp($radtyp); }
    public function setGeschlecht($geschlecht){ $this->geschlecht = new Geschlecht($geschlecht); }
    public function setZustand($zustand){ $this->zustand = new Zustand($zustand); }
    public function setLaufleistung($laufleistung){ $this->laufleistung = new Laufleistung($laufleistung); }
    public function setRadgroesse($radgroesse){ $this->radgroesse = new Radgroesse($radgroesse); }
    public function setRahmenhoehe($rahmenhoehe){ $this->rahmenhoehe = new Rahmenhoehe($rahmenhoehe); }
    public function setMarke($marke){ $this->marke = new Marke($marke); }
    public function setModell($modell){ $this->modell = $modell; }
    public function setFarbe($farbe){ $this->farbe = new Farbe($farbe); }
    public function setBremssystem($bremssystem){ $this->bremssystem = new Bremssystem($bremssystem); }
    public function setSchaltungstyp($schaltungstyp){ $this->schaltungstyp = new Schaltungstyp($schaltungstyp); }
    public function setRahmenmaterial($rahmenmaterial){ $this->rahmenmaterial = new Rahmenmaterial($rahmenmaterial); }
    public function setBeleuchtungsart($beleuchtungsart){ $this->beleuchtungsart = new Beleuchtungsart($beleuchtungsart); }
    public function setEinsatzbereich($einsatzbereich){ $this->einsatzbereich = new Einsatzbereich($einsatzbereich); }
    public function setPreis($preis){ $this->preis = $preis; }
    public function setBilder(Bild $bilder){ $this->preis = $bilder; }
}
?>