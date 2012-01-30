<?php
    include 'includes/head.php';
    include 'includes/ScaleImage.php';
?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
	    <?php
        include 'includes/dbConnect.php';
        
        echo '<div class="search">';
        $sql = "select distinct hersteller from bike";
        $result = mysql_query($sql);
        if($result){
            echo '<select name="hersteller"><option value="-1">Hersteller</option>';
            while ($row = mysql_fetch_assoc($result)) {
                echo '<option>' . $row['hersteller'] . '</option>';
            }
            echo '</select>';
        }

        $sql = "select distinct modell from bike";
        $result = mysql_query($sql);
        if($result){
            echo '<select name="modell"><option value="-1">Modell</option>';
            while ($row = mysql_fetch_assoc($result)) {
                echo '<option>' . $row['modell'] . '</option>';
            }
            echo '</select>';
        }
        echo '</div>';

        $sql = "select bike.uid,bike.pid,hersteller,modell,preis,bike.erstellt,bike.geaendert,name,extension,reihenfolge from bike LEFT OUTER JOIN images ON bike.uid = images.pid";
        $result = mysql_query($sql);
        if($result){
            while ($row = mysql_fetch_assoc($result)) { ?>
                <div class="bikeListElement">
                    <?php if(!empty($row['name'])){
                        $imageObj = new ScaleImage($row['name'], $row['extension'], 'images');
                        $imagePath = $imageObj->getImagePath(200, 'auto');
                        ?>
                        <a class="thumb" href="detail.php?uid=<?=$row['uid']?>">
                            <img alt="<?=$row['modell']?>" src="<?=$imagePath?>" width="200" />
                        </a>
                    <?php } ?>
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
            <?php }
         }else{
             echo '<p class="error">Fehler in der Datenbankabfrage</p>';
         }
        
    ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
