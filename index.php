<?php session_start(); ?>
<?php
    require_once 'auth.php';
    require_once 'config.php';
    require_once 'template.php';
    if(isset($_POST['integrate'])){
        $auth = new Auth(CLIENT_ID, CLIENT_SECRET, REDIRECT_URI, LOGIN_URI);
        $auth->authorize();
        $that = $tasks;
    }
?>
<?php getHead() ?>
<h2> Sales Force API Connection App</h2>
<form method="POST" action="">
    <input type="submit" value="integrate" name="integrate"/>
</form>
<?php if(isset($_SESSION['access_token'])){ ?>
    <a href="crud_dash.php">You are integrated. Go to CRUD command center</a>
<?php } ?>
<?php getFooter() ?>
