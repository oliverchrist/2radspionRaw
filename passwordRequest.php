<?php include 'includes/head.php'; ?>
<body id="std">
    <?php include 'includes/header.php'; ?>
	<div id="content">

	    <form method="post">
            <div class="formField<?=$emailErr?>">
                <p class="error">Bitte geben Sie eine Email ein</p>
                <label>Email</label><input type="text" name="email" value="<?=$email?>" />
            </div>
            <div class="formField">
                <input class="submit" type="submit" />
            </div>
	    </form>

    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
