<?php
include 'includes/init.php';
include 'includes/head.php';
use de\zweiradspion\DatabaseHelper,
    de\zweiradspion\DebugHelper,
    de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper;
?>
<body id="std">
    <?
    $title = 'Alle Angebote';
    if(isset($_GET['filter'])){
        switch ($_GET['filter']) {
            case 'myOffers':
                $title = 'Meine Angebote';
                break;
            case 'notepad':
                $title = 'Merkzettel';
                break;
            default:
                $title = $_GET['filter'];
                break;
        }
    }
    echo HeaderHelper::getHeader($title);
    ?>
	<div id="content">
	    <?=NavigationHelper::getSubnavigation()?>
	    <?php
        echo '<form class="search" method="post">';
        $dbObject = new DatabaseHelper();
        $sql = "select distinct marke from bike";
        $result = mysql_query($sql);
        if($result){
            echo '<select name="marke"><option value="-1">Marke</option>';
            while ($row = mysql_fetch_assoc($result)) {
                $selected = ($row['marke'] != -1 && $row['marke'] == $_POST['marke'])?' selected':'';
                echo '<option' . $selected . '>' . $row['marke'] . '</option>';
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
        $orderDistanceChecked = (isset($_POST['orderDistance'])) ? ' checked="checked"' : '';
        if(isset($_SESSION['lat']) && isset($_SESSION['lng'])){
            echo '<input name="orderDistance" type="checkbox"' . $orderDistanceChecked . '><label>Nahe Angebote zuerst</label>';
        }
        echo '<input type="submit" class="submit" value="Filtern">';
        echo '</form>';

        $condition = array();
        $join = array();
        $order = array();
        $column = array();
        if($_POST){
            if($_POST['marke'] != -1) $condition[] = 'marke = "' . $_POST['marke'] . '"';
            if($_POST['modell'] != -1) $condition[] = 'modell = "' . $_POST['modell'] . '"';
        }
        if(isset($_GET['filter']) && $_GET['filter'] == 'myOffers' && isset($_SESSION['uid'])){
            $condition[] = 'bike.pid = ' . $_SESSION['uid'];
        }
        if(isset($_GET['filter']) && $_GET['filter'] == 'notepad' && isset($_SESSION['uid'])){
            $join [] = 'right join notepad on bike.uid = notepad.id';
            $condition[] = 'notepad.pid=' . $_SESSION['uid'];
            $column[] = ', notepad.id, notepad.remark';
        }
        $sqlAdditionalCondition = '';
        $sqlAdditionalJoin = '';
        $sqlAdditionalColumn = '';
        $sqlOrder = (isset($_POST['orderDistance']) && isset($_SESSION['lat']) && isset($_SESSION['lng'])) ? 'distance ASC, ' : '';
        if(!empty($condition)) $sqlAdditionalCondition = 'where ' . implode(' and ', $condition);
        if(!empty($join)) $sqlAdditionalJoin = ' ' . implode(' ', $join);
        if(!empty($column)) $sqlAdditionalColumn = implode('', $column);
        $sql = "select bike.uid,bike.pid,marke,modell,preis,bike.erstellt,bike.geaendert"
            . ",name,extension,reihenfolge" . $sqlAdditionalColumn;
            if(isset($_SESSION['lat']) && isset($_SESSION['lng'])){
            $sql .= ",user.lat, user.lng, (111.3 * ({$_SESSION['lat']} - user.lat)) as dy, (71.5 * ({$_SESSION['lng']} - user.lng)) as dx"
                . ", sqrt( POW((71.5 * ({$_SESSION['lng']} - user.lng)),2) + POW((111.3 * ({$_SESSION['lat']} - user.lat)),2) ) as distance";
            }
            $sql .= " from bike LEFT JOIN images ON bike.uid = images.pid LEFT JOIN user ON user.uid = bike.pid {$sqlAdditionalJoin}"
            . " {$sqlAdditionalCondition} group by bike.uid order by {$sqlOrder}bike.erstellt";
        #echo $sql;
        $result = mysql_query($sql);
        if($result){
            while ($row = mysql_fetch_assoc($result)) { ?>
                <div class="bikeListElement">
                    <?php if($row['uid'] == NULL && isset($row['id'])){
                        echo 'Das Zweirad mit der ID: ' . $row['id'] . ' wurde gelöscht<br>';
                        echo 'Bemerkung: ' . $row['remark'];
                    }else{ ?>
                        <?php if(!empty($row['name'])){
                            $imageObj = new ScaleImage($row['name'], $row['extension'], 'images');
                            $imagePath = $imageObj->getImagePath(200, 'auto');
                            ?>
                            <a class="thumb" href="detail.php?uid=<?=$row['uid']?>">
                                <img alt="<?=$row['modell']?>" src="<?=$imagePath?>" width="200" />
                            </a>
                        <?php } ?>
                        <div class="cnt">
                            <? /*=DebugHelper::info('id: ' . $row['id'])?>
                            <?=DebugHelper::info('uid: ' . $row['uid'])?>
                            <?=DebugHelper::info('uid: ' . $row['uid'])?>
                            <?=DebugHelper::info('pid: ' . $row['pid'])?>
                            <?=DebugHelper::info('lat: ' . $row['lat'])?>
                            <?=DebugHelper::info('lng: ' . $row['lng'])?>
                            <?=DebugHelper::info('dx: ' . $row['dx'])?>
                            <?=DebugHelper::info('dy: ' . $row['dy'])?>
                            <?=DebugHelper::info('distance: ' . $row['distance']) */?>
                            <? if(isset($row['distance'])){ ?>
                            Entfernung: <?printf("%.2f", $row['distance']);?> km<br>
                            <? } ?>
                            marke: <?=$row['marke']?><br>
                            modell: <?=$row['modell']?><br>
                            preis: <?=$row['preis']?><br>
                            erstellt: <?=$row['erstellt']?><br>
                            geaendert: <?=$row['geaendert']?><br>
                        </div>
                        <div class="links">
                            <a class="txtLnk" href="detail.php?uid=<?=$row['uid']?>">Ansehen</a>
                        </div>
                        <div class="clear"></div>
                    <? } ?>
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
