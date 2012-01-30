<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
	    <?php
            $hash = $_GET['x'];
            if(!$hash) die ('Es wurde kein Hash übergeben<br>');
            echo '<p>Hash: ' . $hash . '</p>';
            
            include 'includes/dbConnect.php';
            $result = mysql_query("SELECT * FROM userunconfirmed WHERE hash = '" . mysql_real_escape_string($hash) . "'");
                
            $row = mysql_fetch_assoc($result);
            if(!$row) die ('<span class="error">Could not find hash</span><br>');
            
            $uid = $row['uid'];
            $hash = $row['hash'];
            $username = $row['username'];
            $password = $row['password'];
            $email = $row['email'];
            
            $result = mysql_query("INSERT INTO user (hash, username, password, email) VALUES ('"
                    . $hash . "', '"
                    . $username . "', '"
                    . $password . "', '"
                    . $email . "')");

            if(!$result){
                die('<span class="error">Could not write to table user</span><br>');
            }else{
                echo 'User wurde in bestätigte Tabelle geschrieben.<br>';
            }
            
            $result = mysql_query("DELETE FROM userunconfirmed WHERE hash = '" . $hash . "'");
            if(!$result){
                die('<span class="error">Could not delete user with hash' . $hash . '</span><br>');
            }else{
                echo 'User with hash' . $hash . ' wurde in Tabelle userunconfirmed gelöscht.<br>';
            }
	    ?>
	    <p><a href="login.php">Login</a></p>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
