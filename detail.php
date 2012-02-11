<?php
include 'includes/head.php';
use de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\Fahrrad;
?>
<body id="std">
    <?=HeaderHelper::getHeader('Detailansicht')?>
	<div id="content">
        <?=NavigationHelper::getSubnavigation()?>
	<?php
	$fahrrad = new Fahrrad();
        if(isset($_GET['uid'])){
            $fahrrad->loadFromDatabase($_GET['uid']);
        
            ?>
            <div class="fahrradSingle" >
                <h1>Single View for Fahrrad</h1>
                uid: <?=$fahrrad->getUid()?><br>
                pid: <?=$fahrrad->getPid()?><br>
                Marke: <?=$fahrrad->getMarke()?><br>
                modell: <?=$fahrrad->getModell()?><br>
                preis: <?=$fahrrad->getPreis()?><br>
                erstellt: <?=$fahrrad->getErstellt()?><br>
                geaendert: <?=$fahrrad->getGeaendert()?><br>
                <? 
                $imageWidth = 510;
                foreach($fahrrad->getBilder() as $bild) {
                    $scaleObj = new ScaleImage($bild->getName(), $bild->getExtension(), 'images');
                    #echo $imageObj->getOriginalImagePath();
                    $imagePath = $scaleObj->getImagePath($imageWidth, 'auto');
                    echo '<a class="lightbox" title="' . $fahrrad->getModell() . '" href="images/' . $bild->getFullName() . '">
                        <img alt="' . $fahrrad->getModell() . '" src="' . $imagePath . '" width="' . $imageWidth . '" />
                    </a>';
                    $imageWidth = 160;
                }
                ?>
                <br>
                <? if(isset($_SESSION['uid']) && $fahrrad->getPid() == $_SESSION['uid']){ ?>
                <a class="txtLnk" href="bike.php?uid=<?=$fahrrad->getUid()?>">Bearbeiten</a><br />
                <a class="txtLnk" href="notepad.php?uid=<?=$fahrrad->getUid()?>">Merkzettel</a><br />
                <? } ?>
                <a class="txtLnk" href="#">Kontakt</a><br />
                <a class="txtLnk" href="location.php?pid=<?=$fahrrad->getPid()?>&uid=<?=$fahrrad->getUid()?>">Ort auf Karte zeigen</a><br />
                <a class="txtLnk" href="list.php">Zurück zur Liste</a><br />
            </div>
        <? } ?>
    </div>          
    <?php include 'includes/footer.php'; ?>
</body>
</html>
