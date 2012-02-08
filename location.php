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
<body id="std" onload="initialize();">
    <?=HeaderHelper::getHeader('Standort')?>
	<div id="content">
	    <?=NavigationHelper::getSubnavigation()?>
	    <?php
	        if(isset($_GET['pid'])){
                $dbObject = new DatabaseHelper();
                $result = mysql_query("select * from user where uid=" . mysql_real_escape_string($_GET['pid']));
                $row = mysql_fetch_assoc($result);
                $uid = $row['uid'];
                $latlng = $row['latLng'];
                $postcode = $row['postcode'];
                $city = $row['city'];
                if(!empty($latlng)){
                ?>
                    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                    <script type="text/javascript">
                      var map;
                      var marker;
                      function initialize() {
                        var myOptions = {
                          zoom: 8,
                          center: new google.maps.LatLng<?=$latlng?>,
                          mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
                        marker = new google.maps.Marker({
                            map: map, 
                            position: new google.maps.LatLng<?=$latlng?>
                        });
                      }
                    </script>        
                    <div id="map_canvas" style="height:500px"></div>
                <? }else{ ?>
                    <p class="error">Keine Koordinaten in Userdaten gefunden</p>
                <? } ?>
                <a class="txtLnk" href="detail.php?uid=<?=$_GET['uid']?>">Zurück</a>  
               <?} ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
