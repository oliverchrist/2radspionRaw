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
        $con = mysql_connect("localhost", "root", "2radklettern");
        if (!$con)
        {
            die('Could not connect: ' . mysql_error());
        }else{
            #echo 'connected with SQL-Server localhost<br>';
        }
        
        $selectDB = mysql_select_db("2radspionraw", $con);
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
}
?>
