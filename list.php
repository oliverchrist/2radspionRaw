<?php
use de\zweiradspion\DatabaseHelper,
    de\zweiradspion\DebugHelper,
    de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\FormHelper,
    de\zweiradspion\Liste,
    de\zweiradspion\Login;

require_once 'includes/init.php';

echo $twig->render('head.html');

$listObj = new Liste();

$pageClass = '';
if(isset($_GET['filter'])){
    switch ($_GET['filter']) {
        case 'myOffers':
            $pageClass = 'myOffers';
            break;
        case 'allOffers':
            $pageClass = 'allOffers';
            break;
        case 'notepad':
            $pageClass = 'notepad';
            break;
        case 'newOffers':
            $pageClass = 'newOffers';
            break;
        case 'nearOffers':
            $pageClass = 'nearOffers';
            break;
        default:
            $pageClass = '';
            break;
    }
}
echo "<body id=\"std\" class=\"$pageClass\">";
echo $twig->render('header.html', array('headline' => $listObj->getHeadline(), 'isLoggedIn' => Login::isLoggedIn()));
?>
<div class="main">
<div id="content">
<?php
echo $twig->render('subnavigation.html', array('isLoggedIn' => Login::isLoggedIn()));



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
