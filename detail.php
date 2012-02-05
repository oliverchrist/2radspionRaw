<?php
include 'includes/head.php';
include 'includes/DatabaseHelper.php';
include 'includes/ScaleImage.php';
include 'includes/DebugHelper.php';
include 'includes/HeaderHelper.php';
include 'includes/NavigationHelper.php';
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper;
?>
<body id="std">
    <?=HeaderHelper::getHeader('Detailansicht')?>
	<div id="content">
        <?=NavigationHelper::getSubnavigation()?>
	    <?php
	    $dbObject = new DatabaseHelper();
        $sql = "select bike.uid,bike.pid,hersteller,modell,preis,bike.erstellt,bike.geaendert,name,extension,reihenfolge from bike LEFT OUTER JOIN images ON bike.uid = images.pid where bike.uid=" . mysql_real_escape_string($_GET['uid']);
        $result = mysql_query($sql);
        $row = mysql_fetch_assoc($result)
        ?>
        <div class="fahrradSingle" >
            <h1>Single View for Fahrrad</h1>
            uid: <?=$row['uid']?><br>
            pid: <?=$row['pid']?><br>
            hersteller: <?=$row['hersteller']?><br>
            modell: <?=$row['modell']?><br>
            preis: <?=$row['preis']?><br>
            erstellt: <?=$row['erstellt']?><br>
            geaendert: <?=$row['geaendert']?><br>
            <? if(!empty($row['name'])){
                $imageObj = new ScaleImage($row['name'], $row['extension'], 'images');
                #echo $imageObj->getOriginalImagePath();
                $imagePath = $imageObj->getImagePath(510, 'auto');
                echo '<img alt="' . $row['modell'] . '" src="' . $imagePath . '" width="510" />';
            } ?>
            <? if(isset($_SESSION['uid']) && $row['pid'] == $_SESSION['uid']){ ?>
            <a class="txtLnk" href="bike.php?uid=<?=$row['uid']?>">Bearbeiten</a><br />
            <? } ?>
            <a class="txtLnk" href="#">Kontakt</a><br />
            <a class="txtLnk" href="list.php">Back to list</a><br />
        </div>
    
    </div>          

    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
