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
    <?=HeaderHelper::getHeader('PHP Info')?>
	<div id="content">
     <?php
     phpinfo();
     ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
