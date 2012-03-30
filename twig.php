<?php
use de\zweiradspion\DatabaseHelper,
    de\zweiradspion\DebugHelper,
    de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\FormHelper,
    de\zweiradspion\Liste,
    de\zweiradspion\Login;

require_once 'includes/init.php';

$listObj = new Liste();
$pageClass = '';
$searchHtml = '';
if(isset($_GET['filter'])) {
    $pageClass = $_GET['filter'];
}

if($_POST){
    $listObj->generateSqlAllOffers();
}
if(isset($_GET['filter']) && $_GET['filter'] == 'allOffers'){
    $listObj->initAllOffers();
    $searchHtml = $listObj->getSearch();
}
if(isset($_GET['filter']) && $_GET['filter'] == 'myOffers' && isset($_SESSION['uid'])){
    $listObj->initMyOffers();
}
if(isset($_GET['filter']) && $_GET['filter'] == 'notepad' && isset($_SESSION['uid'])){
    $listObj->initNotepad();
}
if(isset($_GET['filter']) && $_GET['filter'] == 'newOffers'){
    $listObj->initNewOffers();
}

if(isset($_GET['filter']) && $_GET['filter'] == 'nearOffers'){
    $listObj->initNearOffers();
}

#var_dump($listObj->getList());

echo $twig->render('list.html', array(
        'headline' => $listObj->getHeadline(),
        'isLoggedIn' => Login::isLoggedIn(),
        'pageClass' => $pageClass,
        'linkTarget' => '_top',
        'filter' => $listObj->getFilter(),
        'post' => $_POST,
        'searchHtml' => $searchHtml,
        'bikeListElements' => $listObj->getList()
    ));
