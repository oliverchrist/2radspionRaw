<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
	    <?php
	    include 'includes/dbConnect.php';
        $sql = "select bike.uid,bike.pid,hersteller,modell,preis,bike.erstellt,bike.geaendert,name,extension,reihenfolge from bike LEFT OUTER JOIN images ON bike.uid = images.pid";
        $result = mysql_query($sql);

        if($result){
            while ($row = mysql_fetch_assoc($result)) {
                ?>
                <div class="bikeListElement">
                    <? if(!empty($row['name'])){ ?>
                    <a class="thumb" href="detail.php?uid=<?=$row['uid']?>">
                        <img src="images/<?=$row['name']?>.<?=$row['extension']?>" />
                    </a>
                    <? } ?>
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
            <? }
         }else{
             echo '<p class="error">Fehler in der Datenbankabfrage</p>';
         }
        
    ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
