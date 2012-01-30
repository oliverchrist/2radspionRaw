<?php
    $con = mysql_connect("localhost", "root", "");
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
    }
?>