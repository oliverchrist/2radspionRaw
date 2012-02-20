<?php
include 'includes/init.php';
use de\zweiradspion\DatabaseHelper,
    de\zweiradspion\Fahrrad;

if(isset($_GET['uid']) && isset($_GET['process']) && $_GET['process'] == 'delete'){
    $dbObject = new DatabaseHelper();
    $sql = 'DELETE FROM bike WHERE uid = ' . $_GET['uid'] . ' and pid = ' . $_SESSION['uid'];
    $result = mysql_query($sql);
    if($result){
        # Bilder finden und sicher sein, daß dem User das Bike gehörte (session), deshalb im if Zweig
        $sql = 'SELECT * FROM images WHERE pid = ' . $_GET['uid'];
        $result = mysql_query($sql);
        while($row = mysql_fetch_assoc($result)){
            $filename = 'images/' . $row['name'] . '.' . $row['extension'];
            unlink($filename);
        }
        $sql = 'DELETE FROM images WHERE pid = ' . $_GET['uid'];
        $result = mysql_query($sql);
        echo 'delete';
    }else{
        echo 'error';
    }
}
