<?php
include 'includes/init.php';
include 'includes/head.php';
use de\zweiradspion\DatabaseHelper,
    de\zweiradspion\DebugHelper,
    de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\FormHelper,
    de\zweiradspion\Liste;
?>
<body id="std">
<?
$title = 'Alle Angebote';
if(isset($_GET['filter'])){
    switch ($_GET['filter']) {
        case 'myOffers':
            $title = 'Meine Angebote';
            break;
        case 'allOffers':
            $title = 'Alle Angebote';
            break;
        case 'notepad':
            $title = 'Merkzettel';
            break;
        case 'newOffers':
            $title = 'Neue Angebote';
            break;
        case 'nearOffers':
            $title = 'Nahe Angebote';
            break;
        default:
            $title = $_GET['filter'];
            break;
    }
}
echo HeaderHelper::getHeader($title);
?>
<div class="main">
<div id="content">
<?=NavigationHelper::getSubnavigation()?>
<?php
$listObj = new Liste();

if($_POST){
    $listObj->generateSqlAllOffers();
}
if(isset($_GET['filter']) && $_GET['filter'] == 'allOffers'){
    $listObj->initAllOffers();
    $listObj->printSearch();
}
if(isset($_GET['filter']) && $_GET['filter'] == 'myOffers' && isset($_SESSION['uid'])){
    $listObj->initMyOffers();
    $listObj->printSearch();
}
if(isset($_GET['filter']) && $_GET['filter'] == 'notepad' && isset($_SESSION['uid'])){
    $listObj->initNotepad();
    $listObj->printSearch();
}
if(isset($_GET['filter']) && $_GET['filter'] == 'newOffers'){
    $listObj->initNewOffers();
    $listObj->printTimeSearch();
}

if(isset($_GET['filter']) && $_GET['filter'] == 'nearOffers'){
    $listObj->initNearOffers();
    $listObj->printAreaSearch();
}

$listObj->printList();

?>
</div>
<div class="teaser">
    <div class="info">fooo</div>
</div>
</div>
<?php include 'includes/footer.php'; ?>
</body>
</html>
