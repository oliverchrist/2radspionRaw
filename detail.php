<?php
use de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\Fahrrad,
    de\zweiradspion\ScaleImage,
    de\zweiradspion\Login;

include 'includes/init.php';


$fahrrad = new Fahrrad($_GET['uid']);

$imageWidth = 510;
foreach($fahrrad->getBilder() as $bild) {
    $scaleObj = new ScaleImage($bild->getName(), $bild->getExtension(), 'images');
    #var_dump($scaleObj->getOriginalImageSize());
    $imagePath         = $scaleObj->getImagePath($imageWidth, 'auto');
    $originalImageWidth = $scaleObj->getOriginalImageWidth();
    if($originalImageWidth > 1000) {
        $imagePathLightbox = $scaleObj->getImagePath(1000, 'auto');
    }else{
        $imagePathLightbox = $scaleObj->getOriginalImagePath();
    }
    $bild->setImagePath($imagePath);
    $bild->setOriginalImagePath($imagePathLightbox);
    $bild->setImageWidth($imageWidth);
    $imageWidth = 160;
}

echo $twig->render('detail.html', array(
    'headline' => 'Detailansicht',
    'isLoggedIn' => Login::isLoggedIn(),
    'isOwnBike' => isset($_SESSION['uid']) && $fahrrad->getPid() == $_SESSION['uid'],
    'isOnNotepad' => !empty($fahrrad->getNuid),
    'pageClass' => 'detail',
    'linkTarget' => '_top',
    'fahrrad' => $fahrrad
));