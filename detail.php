<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
	    <?php
	    include 'includes/dbConnect.php';
        $result = mysql_query("select * from bike where uid=" . mysql_real_escape_string($_GET['uid']));
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
            <img alt="a" src="typo3temp/pics/d454b255e3.jpg" width="510" height="383" />
            <? if($row['pid'] == $_SESSION['uid']){ ?>
            <a class="txtLnk" href="bike.php?uid=<?=$row['pid']?>">Bearbeiten</a><br />
            <? } ?>
            <a class="txtLnk" href="#">Kontakt</a><br />
            <a class="txtLnk" href="index.php">Back to list</a><br />
        </div>
    
    </div>          

    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
