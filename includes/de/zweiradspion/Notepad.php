<?php
namespace de\zweiradspion;

require_once 'config/properties.php';

/**
 * Helferfunktionen
 *
 * @author christ
 */
class Notepad {
    protected $uid;
    
    public public function __construct($uid)
    {
        $this->uid = $uid;
    }
    
    public function getNotes(){
        $dbObject = new DatabaseHelper();
        $sql = "select * from notepad where pid = {$_SESSION['uid']}";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_assoc($result)) {
            echo 'foo';
        }
    }
}