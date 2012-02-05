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
        $sql = "select * from bike where uid=" . mysql_real_escape_string($_GET['uid']);
        $sql2 = "select * from images where pid=" . mysql_real_escape_string($_GET['uid']);
        $result = mysql_query($sql);
        $result2 = mysql_query($sql2);
        $row = mysql_fetch_assoc($result);
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
            <?
            $imageWidth = 510;
            while ($row2 = mysql_fetch_assoc($result2)) {
                $imageObj = new ScaleImage($row2['name'], $row2['extension'], 'images');
                #echo $imageObj->getOriginalImagePath();
                $imagePath = $imageObj->getImagePath($imageWidth, 'auto');
                echo '<a class="lightbox" title="' . $row['modell'] . '" href="images/' . $row2['name'] . '.' . $row2['extension'] . '">
                    <img alt="' . $row['modell'] . '" src="' . $imagePath . '" width="' . $imageWidth . '" />
                </a>';
                $imageWidth = 160;
            } ?>
            <br>
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
