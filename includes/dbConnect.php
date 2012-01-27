<?php
    $con = mysql_connect("localhost", "root", "");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }else{
        echo 'connected<br>';
    }
    
    $selectDB = mysql_select_db("2radspionraw", $con);
    echo 'mysql_select_db: ' . $selectDB . '<br>';
?>