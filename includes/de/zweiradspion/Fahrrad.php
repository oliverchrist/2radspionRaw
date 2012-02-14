<?php
namespace de\zweiradspion;
use de\zweiradspion\Bild,
    de\zweiradspion\DatabaseHelper,
    de\zweiradspion\eigenschaft\Radtyp,
    de\zweiradspion\eigenschaft\Geschlecht,
    de\zweiradspion\eigenschaft\Zustand,
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
    
    protected $post;

    public function __construct($uid = NULL){
        $this->bilder = array();
        if(isset($uid)){
            $this->loadFromDatabase($uid);
        }else{
            $this->radtyp = new Radtyp();
            $this->geschlecht = new Geschlecht();
            $this->zustand = new Zustand();
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
    
    private function postToSetterFromSelect($name){
        $nameSonstige = $name . 'Sonstige';
        $setterFunktion = 'set' . ucfirst($name);
        if($this->post[$name] == -1){
            $this->$setterFunktion($this->post[$nameSonstige]);
        }else{
            $this->$setterFunktion($this->post[$name]);
        }
    }
    
    public function loadFromPost($post, $pid){
        $this->post = $post;
        $this->uid = $post['uid'];
        $this->pid = $pid;
        $this->postToSetterFromSelect('marke');
        $this->postToSetterFromSelect('radtyp');
        $this->postToSetterFromSelect('geschlecht');
        $this->postToSetterFromSelect('zustand');
        $this->laufleistung = $post['laufleistung'];
        $this->radgroesse = $post['radgroesse'];
        $this->rahmenhoehe = $post['rahmenhoehe'];
        $this->postToSetterFromSelect('marke');
        $this->modell = $post['modell'];
        $this->postToSetterFromSelect('farbe');
        $this->postToSetterFromSelect('bremssystem');
        $this->postToSetterFromSelect('schaltungstyp');
        $this->postToSetterFromSelect('rahmenmaterial');
        $this->postToSetterFromSelect('beleuchtungsart');
        $this->postToSetterFromSelect('einsatzbereich');
        $this->preis = $post['preis'];
    }
    
    public function updateInDatabase(){
        $dbObject = new DatabaseHelper();
        $sql = 'UPDATE bike SET '
            . 'modell="' . mysql_real_escape_string(trim($this->modell)) . '", '
            . 'preis="' . mysql_real_escape_string(trim($this->preis)) . '", '
            . 'radtyp="' . mysql_real_escape_string(trim($this->radtyp->getValue())) . '", '
            . 'geschlecht="' . mysql_real_escape_string(trim($this->geschlecht->getValue())) . '", '
            . 'zustand="' . mysql_real_escape_string(trim($this->zustand->getValue())) . '", '
            . 'laufleistung="' . mysql_real_escape_string(trim($this->laufleistung)) . '", '
            . 'radgroesse="' . mysql_real_escape_string(trim($this->radgroesse)) . '", '
            . 'rahmenhoehe="' . mysql_real_escape_string(trim($this->rahmenhoehe)) . '", '
            . 'marke="' . mysql_real_escape_string(trim($this->marke->getValue())) . '", '
            . 'modell="' . mysql_real_escape_string(trim($this->modell)) . '", '
            . 'farbe="' . mysql_real_escape_string(trim($this->farbe->getValue())) . '", '
            . 'bremssystem="' . mysql_real_escape_string(trim($this->bremssystem->getValue())) . '", '
            . 'schaltungstyp="' . mysql_real_escape_string(trim($this->schaltungstyp->getValue())) . '", '
            . 'rahmenmaterial="' . mysql_real_escape_string(trim($this->rahmenmaterial->getValue())) . '", '
            . 'beleuchtungsart="' . mysql_real_escape_string(trim($this->beleuchtungsart->getValue())) . '", '
            . 'einsatzbereich="' . mysql_real_escape_string(trim($this->einsatzbereich->getValue())) . '", '   
            . 'geaendert=CURRENT_TIMESTAMP '         
            . 'WHERE uid=' . mysql_real_escape_string(trim($this->uid)) . ' and pid=' . mysql_real_escape_string(trim($this->pid));
        #echo $sql;
        $result = mysql_query($sql);
        if(!$result){
            $exceptionText = 'Fahrrad konnte nicht in der Datenbank bike upgedated werden<br>';
            if(DEBUG){
                $exceptionText .= $sql . '<br>';
            }
            throw new \Exception($exceptionText);
        }
    }
    
    public function insertInDatabase(){
        $dbObject = new DatabaseHelper();
        $sql = 'INSERT INTO bike (pid, preis, radtyp, geschlecht, zustand, laufleistung, radgroesse, rahmenhoehe, marke, modell, farbe, bremssystem, schaltungstyp, rahmenmaterial, beleuchtungsart, einsatzbereich, erstellt, geaendert) VALUES ('
            . $_SESSION['uid'] . ', '
            . mysql_real_escape_string(trim($this->preis)) . ', '
            . '"' . mysql_real_escape_string(trim($this->radtyp->getValue())) . '", '
            . '"' . mysql_real_escape_string(trim($this->geschlecht->getValue())) . '", '
            . '"' . mysql_real_escape_string(trim($this->zustand->getValue())) . '", '
            . mysql_real_escape_string(trim($this->laufleistung)) . ', '
            . mysql_real_escape_string(trim($this->radgroesse)) . ', '
            . mysql_real_escape_string(trim($this->rahmenhoehe)) . ', '
            . '"' . mysql_real_escape_string(trim($this->marke->getValue())) . '", '
            . '"' . mysql_real_escape_string(trim($this->modell)) . '", '
            . '"' . mysql_real_escape_string(trim($this->farbe->getValue())) . '", '
            . '"' . mysql_real_escape_string(trim($this->bremssystem->getValue())) . '", '
            . '"' . mysql_real_escape_string(trim($this->schaltungstyp->getValue())) . '", '
            . '"' . mysql_real_escape_string(trim($this->rahmenmaterial->getValue())) . '", '
            . '"' . mysql_real_escape_string(trim($this->beleuchtungsart->getValue())) . '", '
            . '"' . mysql_real_escape_string(trim($this->einsatzbereich->getValue())) . '", '   
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
    public function setLaufleistung($laufleistung){ $this->laufleistung = $laufleistung; }
    public function setRadgroesse($radgroesse){ $this->radgroesse = $radgroesse; }
    public function setRahmenhoehe($rahmenhoehe){ $this->rahmenhoehe = $rahmenhoehe; }
    public function setMarke($marke){ $this->marke = new Marke($marke); }
    public function setModell($modell){ $this->modell = $modell; }
    public function setFarbe($farbe){ $this->farbe = new Farbe($farbe); }
    public function setBremssystem($bremssystem){ $this->bremssystem = new Bremssystem($bremssystem); }
    public function setSchaltungstyp($schaltungstyp){ $this->schaltungstyp = new Schaltungstyp($schaltungstyp); }
    public function setRahmenmaterial($rahmenmaterial){ $this->rahmenmaterial = new Rahmenmaterial($rahmenmaterial); }
    public function setBeleuchtungsart($beleuchtungsart){ $this->beleuchtungsart = new Beleuchtungsart($beleuchtungsart); }
    public function setEinsatzbereich($einsatzbereich){ $this->einsatzbereich = new Einsatzbereich($einsatzbereich); }
    public function setPreis($preis){ $this->preis = $preis; }
    public function setBilder(Bild $bilder){ $this->bilder = $bilder; }
}
?>