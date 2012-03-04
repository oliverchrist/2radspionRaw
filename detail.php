<?php
include 'includes/init.php';
include 'includes/head.php';
use de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\Fahrrad,
    de\zweiradspion\ScaleImage;
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
        aktiv: <?=($fahrrad->getAktiv()) ? 'aktiv' : 'inaktiv' ?><br>
        erstellt: <?=$fahrrad->getErstellt()?><br>
        geaendert: <?=$fahrrad->getGeaendert()?><br>
        Beschreibung: <?=$fahrrad->getBeschreibung()?><br>
    <?
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
        echo '<a class="lightbox" title="' . $fahrrad->getModell() . '" href="' . $imagePathLightbox . '">
            <img alt="' . $fahrrad->getModell() . '" src="' . $imagePath . '" width="' . $imageWidth . '" />
        </a>';
        $imageWidth = 160;
    }
    ?>
    <br>
    <div class="links">
    <? # angemeldet und eigenes Zweirad
    if(isset($_SESSION['uid']) && $fahrrad->getPid() == $_SESSION['uid']){ ?>
        <a class="txtLnk" href="bike.php?uid=<?=$fahrrad->getUid()?>">Bearbeiten</a><br />
        <a class="txtLnk delete" href="bike.php?uid=<?=$fahrrad->getUid()?>&process=delete">Löschen</a><br>
        <?
    }
    # angemeldet und fremdes Zweirad
    if(isset($_SESSION['uid']) && $fahrrad->getPid() != $_SESSION['uid']){ ?>
        <a class="txtLnk" href="notepad.php?uid=<?=$fahrrad->getUid()?>">Auf Merkzettel speichern</a><br />
        <?
    }
    # alle Bikes
    ?>
    <a class="txtLnk" href="contact.php?uid=<?=$fahrrad->getUid()?>">Kontakt</a><br />
    <a class="txtLnk" href="tellAFriend.php?uid=<?=$fahrrad->getUid()?>">Weiterleiten</a><br />
    <a class="txtLnk" href="location.php?uid=<?=$fahrrad->getUid()?>&pid=<?=$fahrrad->getPid()?>">Karte</a><br />
    <a class="txtLnk print" href="#">Drucken</a><br />
    <a class="txtLnk" href="list.php">Zurück zur Liste</a><br />
    </div>
    </div>
    <?
} ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
