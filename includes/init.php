<?php
include 'includes/properties/properties.php';
function __autoload($className){
    #echo "load Class: $className<br>";

    if (0 !== strpos($className, 'Twig')) {
        $fileName = 'includes/' . str_replace('\\', '/', $className) . '.php';
    }else if (is_file($fileName = 'includes/'.str_replace(array('_', "\0"), array('/', ''), $className).'.php')) {
        require $fileName;
    }

    #echo "classpath: $fileName<br>";
    require_once $fileName;
}

session_start();
/*
require_once '/usr/share/php/Twig/Autoloader.php';
Twig_Autoloader::register();
*/


$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
  #'cache' => 'compilation_cache',
));


?>