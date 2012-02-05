<?php
    session_start();
    $_SESSION = array(); 
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-86400, '/');
    }
    session_destroy();
?>
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
    <?=HeaderHelper::getHeader('Logout')?>
	<div id="content">
        <?=NavigationHelper::getSubnavigation()?>
        <p>Sie wurden ausgeloggt</p>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
