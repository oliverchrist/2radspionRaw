<?php
require_once '/usr/share/php/Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
  'cache' => 'compilation_cache',
));







include 'includes/init.php';
include 'includes/head.php';
?>
<body id="home">
    <?php
    echo $twig->render('index.html', array('name' => 'Fabien'));
    ?>
    <div class="logoBgr"></div>
    <a href="list.php" class="logoBgr2"></a>
    <div class="headerBgr"></div>
    <div class="borderBottom"><div class="border"></div></div>
    <div class="borderRight"><div class="border"></div></div>
    <div class="claim">
        <div class="text">Der online-Markt für neue und gebrauchte Zweiräder / vom Hobby bis zum professionellen Einsatz / von privat oder vom Händler</div>
        <div class="border"><img src="resources/images/logo_folgeseiten.png" id="imgLogoHome" /></div>
    </div>

    <div class="menu">
        <a href="#" >suchen</a>
        <a href="#" >anbieten</a>
        <a href="#" style="margin-left: 10em;">Kontakt</a>
        <a href="datenschutz.php" >Datenschutz</a>
        <a href="agb.php" >AGB</a>
        <a href="#" >Impressum</a>
    </div>

</body>
</html>