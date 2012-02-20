<?php
include 'includes/init.php';
include 'includes/head.php';
use de\zweiradspion\HeaderHelper;
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
