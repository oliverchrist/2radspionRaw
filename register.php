<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">
	    <?php
	    #var_dump($_POST);
        echo 'Benutzername: ' . $_POST['username'] . '<br>';  
        echo 'Benutzername: ' . $_POST['password'] . '<br>';  
        echo 'Benutzername: ' . $_POST['password2'] . '<br>';  
        echo 'Benutzername: ' . $_POST['email'] . '<br>';  
	    ?>
	    <form method="post">
	        <div class="formField">
                <label>Benutzername</label><input type="text" name="username" />
            </div>
            <div class="formField">
                <label>Passwort</label><input type="text" name="password" />
            </div>
            <div class="formField">
                <label>Passwort wiederholen</label><input type="text" name="password2" />
            </div>
            <div class="formField">
                <label>Email</label><input type="text" name="email" />
            </div>
            <div class="formField">
                <input class="submit" type="submit" />
            </div>
	    </form>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
