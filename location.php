<?php
include 'includes/init.php';
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper,
	de\zweiradspion\Login;

if(isset($_GET['pid'])){
    $dbObject = new DatabaseHelper();
    $result   = mysql_query("select * from user where uid=" . mysql_real_escape_string($_GET['pid']));
    $row      = mysql_fetch_assoc($result);
    $lat      = $row['lat'];
    $lng      = $row['lng'];
    $postcode = $row['postcode'];
    $city     = $row['city'];

    echo $twig->render('location.html', array(
        'headline' => 'Standort',
        'isLoggedIn' => Login::isLoggedIn(),
        'pageClass' => 'location',
        'linkTarget' => '_top',
        'hasCoordinates' => !empty($lat) && !empty($lng),
        'lat' => $lat,
        'lng' => $lng,
        'uid' => isset($_GET['uid']) ? $_GET['uid'] : NULL,
        'pid' => isset($_GET['pid']) ? $_GET['pid'] : NULL
    ));
}
?>