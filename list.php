<?php
require_once 'includes/init.php';

echo $twig->render('head.html');

use de\zweiradspion\DatabaseHelper,
    de\zweiradspion\DebugHelper,
    de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\FormHelper,
    de\zweiradspion\Liste,
    de\zweiradspion\Login;

$title     = 'Alle Angebote';
$pageClass = '';
if(isset($_GET['filter'])){
    switch ($_GET['filter']) {
        case 'myOffers':
            $title     = 'Meine Angebote';
            $pageClass = 'myOffers';
            break;
        case 'allOffers':
            $title     = 'Alle Angebote';
            $pageClass = 'allOffers';
            break;
        case 'notepad':
            $title     = 'Merkzettel';
            $pageClass = 'notepad';
            break;
        case 'newOffers':
            $title     = 'Neue Angebote';
            $pageClass = 'newOffers';
            break;
        case 'nearOffers':
            $title     = 'Angebote in meiner Nähe';
            $pageClass = 'nearOffers';
            break;
        default:
            $title     = $_GET['filter'];
            $pageClass = '';
            break;
    }
}
echo "<body id=\"std\" class=\"$pageClass\">";
echo HeaderHelper::getHeader($title);
?>
<div class="main">
<div id="content">
<?php
echo $twig->render('subnavigation.html', array('isLoggedIn' => Login::isLoggedIn()));

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
    #$listObj->printSearch();
}
if(isset($_GET['filter']) && $_GET['filter'] == 'notepad' && isset($_SESSION['uid'])){
    $listObj->initNotepad();
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
    <div class="info"></div>
</div>
</div>
<?php include 'includes/footer.php'; ?>
</body>
</html>
