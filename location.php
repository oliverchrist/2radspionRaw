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
<body id="std" onload="initialize()">
    <?=HeaderHelper::getHeader('Standort')?>
	<div id="content">
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
          function initialize() {
            var latlng = new google.maps.LatLng(-34.397, 150.644);
            var myOptions = {
              zoom: 8,
              center: latlng,
              mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
          }
        
        </script>
        <div id="map_canvas" style="height:500px"></div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
