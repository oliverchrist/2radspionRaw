<?php
namespace de\zweiradspion;
use de\zweiradspion\DatabaseHelper;

/**
 * Der User
 *
 * @author christ
 */
class Search extends Persistenz implements DatabaseObject {

    public function __construct($uid = NULL) {
        if(isset($uid)){
            $this->loadFromDatabase($uid);
        }
    }

    public function loadFromDatabase($value, $field = 'uid', $database = 'search') {
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

    public function updateInDatabase($database = 'user') {
        new DatabaseHelper();
        $keyValues = array();
        foreach($this->variable as $key => $value){
            if(empty($value)) continue;
            $keyValues[]   = $key . ' = "' . $value . '"';
        }
        $sql = 'UPDATE ' . $database . ' SET '
            . implode(', ', $keyValues) . ', geaendert = CURRENT_TIMESTAMP '
            . 'WHERE uid=' . mysql_real_escape_string($_SESSION['uid']);
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