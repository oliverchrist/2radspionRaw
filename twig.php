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
if(isset($_GET['filter'])) {
    $pageClass = $_GET['filter'];
}

if($_POST){
    $listObj->generateSqlAllOffers();
}
if(isset($_GET['filter']) && $_GET['filter'] == 'allOffers'){
    $listObj->initAllOffers();
    $listObj->printSearch();
}
if(isset($_GET['filter']) && $_GET['filter'] == 'myOffers' && isset($_SESSION['uid'])){
    $listObj->initMyOffers();
    #$listObj->printSearch();
}
if(isset($_GET['filter']) && $_GET['filter'] == 'notepad' && isset($_SESSION['uid'])){
    $listObj->initNotepad();
}
if(isset($_GET['filter']) && $_GET['filter'] == 'newOffers'){
    $listObj->initNewOffers();
    #$listObj->printTimeSearch();
}

if(isset($_GET['filter']) && $_GET['filter'] == 'nearOffers'){
    $listObj->initNearOffers();
    $listObj->printAreaSearch();
}

#var_dump($listObj->getList());

echo $twig->render('list.html', array(
        'headline' => $listObj->getHeadline(),
        'isLoggedIn' => Login::isLoggedIn(),
        'pageClass' => $pageClass,
        'linkTarget' => '_top',
        'filter' => $listObj->getFilter(),
        'post' => $_POST,
        'bikeListElements' => $listObj->getList()
    ));
