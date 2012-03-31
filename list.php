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
$page = 0;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
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
$list = $listObj->getList();


echo $twig->render('list.html', array(
        'headline' => $listObj->getHeadline(),
        'isLoggedIn' => Login::isLoggedIn(),
        'pageClass' => $pageClass,
        'linkTarget' => '_top',
        'filter' => $listObj->getFilter(),
        'post' => $_POST,
        'searchHtml' => $searchHtml,
        'bikeListElements' => array_slice($list, $page * ENTRIES_PER_PAGE, ENTRIES_PER_PAGE),
        'page' => $page,
        'pages' => ceil(count($list) / ENTRIES_PER_PAGE),
        'hasMorePages' => $page > 0 || (count($list) > ENTRIES_PER_PAGE),
        'hasNext' => (count($list) > ($page * ENTRIES_PER_PAGE)),
        'hasPrev' => $page > 0
    ));
