<?php
namespace de\zweiradspion;
use de\zweiradspion\DatabaseHelper;

/**
 * Der User
 *
 * @author christ
 */
class User extends Persistenz implements DatabaseObject {

    public function __construct($uid = NULL) {
        if(isset($uid)){
            $this->loadFromDatabase($uid);
        }
    }

    public function loadFromDatabase($value, $field = 'uid', $database = 'user') {
        new DatabaseHelper();
        $value = \mysql_real_escape_string($value);

        # hole Fahrrad Daten aus DB
        $sql    = "select * from {$database} where $field='{$value}'";
        $result = mysql_query($sql);
        $row    = mysql_fetch_assoc($result);
        foreach($row as $key => $val){
            $setterFunction = 'set' . ucfirst($key);
            $this->$setterFunction($val);
        }
    }

    public function loadFromPost($post) {
        foreach ($post as $key => $value) {
            $method = 'set' . ucfirst($key);
            $this->$method($value);
        }
    }

    public function updateInDatabase() {
        new DatabaseHelper();
        $sql = 'UPDATE userunconfirmed SET '
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
            . 'aktiv=' . mysql_real_escape_string(trim($this->aktiv)) . ', '
            . 'beschreibung="' . mysql_real_escape_string(trim($this->beschreibung)) . '", '
            . 'geaendert = CURRENT_TIMESTAMP '
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

    public function insertInDatabase($database = 'user') {
        new DatabaseHelper();
        $values = array();
        $keys   = array();
        foreach($this->variable as $key => $value){
            if(empty($value)) continue;
            $keys[]   = $key;
            $values[] = "'$value'";
        }
        $sql = 'insert into ' . $database . ' '
            . '(' . implode(', ', $keys) . ', erstellt, geaendert) '
            . 'values (' . implode(', ', $values) . ', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)';
        #echo $sql;

        $result = mysql_query($sql);

        if(!$result){
            $exceptionText = 'User konnte nicht in die Datenbank geschrieben werden<br>';
            if(DEBUG){
                $exceptionText .= $sql . '<br>';
            }
            throw new \Exception($exceptionText);
        }
    }
}
?>