<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
	    <?php
            include 'includes/dbConnect.php';
            
            $mysqlQuerySelect = mysql_query("select * from userunconfirmed,user"); // where username='olli'
            while($row = mysql_fetch_assoc($mysqlQuerySelect)){
                var_dump($row);
            }
            
            
            
                
	    ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
