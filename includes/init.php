<?php
include 'includes/properties/properties.php';
function __autoload($className){
    $fileName = 'includes/' . str_replace('\\', '/', $className) . '.php';
    #echo "load Class: $fileName<br>";
    require $fileName;
}

session_start();
?>