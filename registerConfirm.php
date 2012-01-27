<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
	    <?php
            $hash = $_GET['x'];
            echo '<p>' . $hash . '</p>';
            include 'includes/dbConnect.php';
            
            $result = mysql_query("SELECT * FROM userunconfirmed WHERE hash = " . $hash);
                
            $row = mysql_fetch_assoc($result);
            
            $uid = $row['uid'];
            $hash = $row['hash'];
            $username = $row['username'];
            $password = $row['password'];
            $email = $row['email'];
            
            $result = mysql_query("INSERT INTO userunconfirmed (hash, username, password, email) VALUES ('"
                    . $hash . "', '"
                    . $username . "', '"
                    . $password . "', '"
                    . $email . "')");
            
            
                
	    ?>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
