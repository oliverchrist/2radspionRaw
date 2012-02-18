<?php
namespace de\zweiradspion;

/**
 * Helferfunktionen
 *
 * @author christ
 */
class DatabaseHelper {
    protected $connected;
    
    public function __construct(){
        $con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
        if (!$con)
        {
            die('Could not connect: ' . mysql_error());
        }else{
            #echo 'connected with SQL-Server localhost<br>';
        }
        
        $selectDB = mysql_select_db(DB_DATABASE, $con);
        if(!$selectDB){
            die ('Could not connect to 2radspionraw<br>');
        }else{
            #echo 'connected with DB 2radspionraw<br>';
            $this->connected = true;
        } 
    }
    
    public function valueInTable($value, $field, $table){
        $sql = 'select ' . $field . ' from ' . $table . ' where ' . $field . '="' . mysql_real_escape_string($value) . '"';
        #print_r($sql);
        $result = mysql_query($sql);
        #print_r(mysql_num_rows($result));
        if(mysql_num_rows($result) > 0){
            return true;
        }
        return false;
    }
    
    public function generateFilterDropdown($field, $table){
        $sql = "select distinct $field from $table order by $field asc";
        #echo $_POST[$field];
        #print_r($_POST);
        $result = mysql_query($sql);
        if($result){
            echo '<select name="' . $field . '"><option value="-1">' . ucfirst($field) . '</option>';
            while ($row = mysql_fetch_assoc($result)) {
                $selected = ($row[$field] != -1 && isset($_POST[$field]) && $row[$field] == $_POST[$field])?' selected':'';
                echo '<option' . $selected . '>' . $row[$field] . '</option>';
            }
            echo '</select>';
        }
    }
    
    public function generateCondition($condition, $field, $relationalOperator = '='){
        if(isset($_POST[$field]) && $_POST[$field] != -1 && !empty($_POST[$field])){
            $condition[] = "$field $relationalOperator '{$_POST[$field]}'";
        }
        return $condition;
    }
}
?>
