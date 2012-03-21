<?php
include 'includes/properties/properties.php';
function __autoload($className){
    $fileName = 'includes/' . str_replace('\\', '/', $className) . '.php';
    #echo "load Class: $fileName<br>";
    require $fileName;
}

session_start();

require_once '/usr/share/php/Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
  'cache' => 'compilation_cache',
));
?>