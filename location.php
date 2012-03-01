<?php
include 'includes/init.php';
include 'includes/head.php';
use de\zweiradspion\DatabaseHelper;
use de\zweiradspion\DebugHelper;
use de\zweiradspion\HeaderHelper;
use de\zweiradspion\NavigationHelper;
?>
<body id="std" onload="initialize();">
    <?=HeaderHelper::getHeader('Standort')?>
    <div id="content">
<?=NavigationHelper::getSubnavigation()?>
<?php
if(isset($_GET['pid'])){
    $dbObject = new DatabaseHelper();
    $result   = mysql_query("select * from user where uid=" . mysql_real_escape_string($_GET['pid']));
    $row      = mysql_fetch_assoc($result);
    $uid      = $row['uid'];
    $lat      = $row['lat'];
    $lng      = $row['lng'];
    $postcode = $row['postcode'];
    $city     = $row['city'];
    if(!empty($lat) && !empty($lng)){ ?>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
          var map;
          var marker;
          function initialize() {
            var myOptions = {
              zoom: 8,
              center: new google.maps.LatLng(<?=$lat?>, <?=$lng?>),
              mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
            marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(<?=$lat?>, <?=$lng?>)
            });
          }
        </script>
        <div id="map_canvas" style="height:500px"></div>
        <?
    }else{ ?>
        <p class="error">Keine Koordinaten in Userdaten gefunden</p>
    <? } ?>
    <?
    if(isset($_GET['uid'])){ ?>
        <a class="txtLnk" href="detail.php?uid=<?=$_GET['uid']?>">Zurück</a>
    <?
    }else{ ?>
        <a class="txtLnk" href="user.php?uid=<?=$_GET['pid']?>">Zurück</a>
    <? } ?>
<?
} ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
