<?php
include 'includes/init.php';
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
	
        if(isset($_GET['uid'])){
            $fahrrad = new Fahrrad($_GET['uid']);
            ?>
            <div class="fahrradSingle" >
                Marke: <?=$fahrrad->getMarke()->getValue()?><br>
                modell: <?=$fahrrad->getModell()?><br>
                preis: <?=$fahrrad->getPreis()?><br>
                Radtyp: <?=$fahrrad->getRadtyp()->getText()?><br>
                Geschlecht: <?=$fahrrad->getGeschlecht()->getText()?><br>
                Zustand: <?=$fahrrad->getZustand()->getText()?><br>
                Laufleistung: <?=$fahrrad->getLaufleistung()?><br>
                Radgroesse: <?=$fahrrad->getRadgroesse()?><br>
                Rahmenhoehe: <?=$fahrrad->getRahmenhoehe()?><br>
                Farbe: <?=$fahrrad->getFarbe()->getText()?><br>
                Bremssystem: <?=$fahrrad->getBremssystem()->getText()?><br>
                Schaltungstyp: <?=$fahrrad->getSchaltungstyp()->getText()?><br>
                Rahmenmaterial: <?=$fahrrad->getRahmenmaterial()->getText()?><br>
                Beleuchtungsart: <?=$fahrrad->getBeleuchtungsart()->getText()?><br>
                Einsatzbereich: <?=$fahrrad->getEinsatzbereich()->getText()?><br>                
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
                <? } ?>
                <? if(isset($_SESSION['uid']) && $fahrrad->getPid() != $_SESSION['uid']){ ?>
                <a class="txtLnk" href="notepad.php?uid=<?=$fahrrad->getUid()?>">Auf Merkzettel speichern</a><br />
                <? } ?>
                <a class="txtLnk" href="#">Kontakt</a><br />
                <a class="txtLnk" href="location.php?pid=<?=$fahrrad->getPid()?>&uid=<?=$fahrrad->getUid()?>">Karte</a><br />
                <a class="txtLnk" href="list.php">Zurück zur Liste</a><br />
            </div>
        <? } ?>
    </div>          
    <?php include 'includes/footer.php'; ?>
</body>
</html>
