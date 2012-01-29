<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
	    <?php
	    include 'includes/dbConnect.php';
        $result = mysql_query("select * from bike");
        while ($row = mysql_fetch_assoc($result)) {
            ?>
            <div class="bikeListElement">
                <a class="thumb" href="#">
                    image
                    <!--img src="typo3temp/pics/1806ba803d.jpg" width="125" height="94" /-->
                </a>
                <div class="cnt">
                    uid: <?=$row['uid']?><br>
                    pid: <?=$row['pid']?><br>
                    hersteller: <?=$row['hersteller']?><br>
                    modell: <?=$row['modell']?><br>
                    preis: <?=$row['preis']?><br>
                    erstellt: <?=$row['erstellt']?><br>
                    geaendert: <?=$row['geaendert']?><br>
                </div>
                <div class="links">
                    <a class="txtLnk" href="detail.php?uid=<?=$row['uid']?>">Ansehen</a>
                </div>
                <div class="clear"></div>
            </div>            
        <? } ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
