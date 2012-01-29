<?php
    $_SESSION = array(); 
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-86400, '/');
    }
    session_destroy();
?>
<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
        <p>Sie wurden ausgeloggt</p>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
