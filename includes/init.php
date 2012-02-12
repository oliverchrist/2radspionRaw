<?php
include 'includes/properties/properties.php';
function __autoload($className){
    $fileName = 'includes/' . str_replace('\\', '/', $className) . '.php';
    #echo "load Class: $fileName<br>";
    require $fileName;
}

if(!isset($_SESSION)) session_start();
?>