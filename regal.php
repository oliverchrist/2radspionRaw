<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="resources/stylesheets/screen.css" type="text/css" rel="stylesheet">
    <link href="resources/stylesheets/print.css" type="text/css" rel="stylesheet" media="print">
    <link href="resources/stylesheets/jquery.lightbox-0.5.css" type="text/css" rel="stylesheet">
    <link href="resources/stylesheets/thickbox.css" type="text/css" rel="stylesheet" media="screen" />
    <script src="resources/js/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script src="resources/js/jquery.lightbox-0.5.pack.js" type="text/javascript"></script>
    <script src="resources/js/thickbox-compressed.js" type="text/javascript"></script>
    <script src="resources/js/script.js" type="text/javascript"></script>
    <style>
        #regal .row { border-bottom: 3px solid grey; line-height: 0; }
        #regal .row.odd { padding-left: 50px; }
        #regal .col { display: inline-block; width: 100px; height: 100px; background: black; margin-left: 100px; }
    </style>
<title>Regal</title>
</head>
<body id="regal">
<?php
    for ($row=0; $row < 10; $row++) {
        $evenOdd = ($row%2 == 1) ? 'even' : 'odd'; 
        echo '<div class="row ' . $evenOdd . '">';
            for ($col=0; $col < 8; $col++) { 
                echo '<div class="col"></div>';
            }
        echo '</div>';
    }
?>
</body>
</html>    