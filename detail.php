<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
	    <?php
	    include 'includes/dbConnect.php';
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
            <? if(!empty($row['name'])){ ?>
                <img alt="a" src="images/<?=$row['name']?>.<?=$row['extension']?>" width="510" />
            <? } ?>
            <? if($row['pid'] == $_SESSION['uid']){ ?>
            <a class="txtLnk" href="bike.php?uid=<?=$row['uid']?>">Bearbeiten</a><br />
            <? } ?>
            <a class="txtLnk" href="#">Kontakt</a><br />
            <a class="txtLnk" href="index.php">Back to list</a><br />
        </div>
    
    </div>          

    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
