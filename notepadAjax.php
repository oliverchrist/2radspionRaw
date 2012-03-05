<?php
include 'includes/init.php';
use de\zweiradspion\DatabaseHelper;

if(isset($_GET['uid']) && isset($_GET['process']) && $_GET['process'] == 'delete'){
    $dbObject = new DatabaseHelper();
    $sql      = 'DELETE FROM notepad WHERE uid = ' . $_GET['uid'] . ' and pid = ' . $_SESSION['uid'];
    #echo $sql;
    $result   = mysql_query($sql);
    if($result){
        echo 'delete';
    }else{
        echo 'error';
    }
}
