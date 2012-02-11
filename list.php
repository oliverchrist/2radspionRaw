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
    <?
    $title = (isset($_GET['filter']))?'Meine Angebote':'Alle Angebote';
    echo HeaderHelper::getHeader($title);
    ?>
	<div id="content">
	    <?=NavigationHelper::getSubnavigation()?>
	    <?php
        echo '<form class="search" method="post">';
        $dbObject = new DatabaseHelper();
        $sql = "select distinct hersteller from bike";
        $result = mysql_query($sql);
        if($result){
            echo '<select name="hersteller"><option value="-1">Hersteller</option>';
            while ($row = mysql_fetch_assoc($result)) {
                $selected = ($row['hersteller'] != -1 && $row['hersteller'] == $_POST['hersteller'])?' selected':'';
                echo '<option' . $selected . '>' . $row['hersteller'] . '</option>';
            }
            echo '</select>';
        }

        $sql = "select distinct modell from bike";
        $result = mysql_query($sql);
        if($result){
            echo '<select name="modell"><option value="-1">Modell</option>';
            while ($row = mysql_fetch_assoc($result)) {
                $selected = ($row['modell'] != -1 && $row['modell'] == $_POST['modell'])?' selected':'';
                echo '<option' . $selected . '>' . $row['modell'] . '</option>';
            }
            echo '</select>';
        }
        echo '</form>';

        $condition = array();
        $join = array();
        if($_POST){
            if($_POST['hersteller'] != -1) $condition[] = 'hersteller = "' . $_POST['hersteller'] . '"';
            if($_POST['modell'] != -1) $condition[] = 'modell = "' . $_POST['modell'] . '"';
        }
        if(isset($_GET['filter']) && $_GET['filter'] == 'myOffers' && isset($_SESSION['uid'])){
            $condition[] = 'bike.pid = ' . $_SESSION['uid'];
        }
        if(isset($_GET['filter']) && $_GET['filter'] == 'notepad' && isset($_SESSION['uid'])){
            $join [] = 'left join notepad on bike.uid = notepad.id';
            $condition[] = 'notepad.pid=' . $_SESSION['uid'];
        }
        $sqlAdditionalCondition = '';
        $sqlAdditionalJoin = '';
        if(!empty($condition)) $sqlAdditionalCondition = 'where ' . implode(' and ', $condition);
        if(!empty($join)) $sqlAdditionalJoin = ' ' . implode(' ', $join);
        $sql = "select bike.uid,bike.pid,hersteller,modell,preis,bike.erstellt,bike.geaendert"
            . ",name,extension,reihenfolge"
            . ",user.lat, user.lng, (111.3 * ({$_SESSION['lat']} - user.lat)) as dy, (71.5 * ({$_SESSION['lng']} - user.lng)) as dx"
            . ", sqrt( POW((71.5 * ({$_SESSION['lng']} - user.lng)),2) + POW((111.3 * ({$_SESSION['lat']} - user.lat)),2) ) as distance"
            . " from bike LEFT JOIN images ON bike.uid = images.pid LEFT JOIN user ON user.uid = bike.pid {$sqlAdditionalJoin}"
            . " {$sqlAdditionalCondition} group by bike.uid order by bike.erstellt";
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
                        <?=DebugHelper::info('uid: ' . $row['uid'])?>
                        <?=DebugHelper::info('pid: ' . $row['pid'])?>
                        <?=DebugHelper::info('lat: ' . $row['lat'])?>
                        <?=DebugHelper::info('lng: ' . $row['lng'])?>
                        <?=DebugHelper::info('dx: ' . $row['dx'])?>
                        <?=DebugHelper::info('dy: ' . $row['dy'])?>
                        <?=DebugHelper::info('distance: ' . $row['distance'])?>
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
