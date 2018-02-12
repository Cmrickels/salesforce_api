<?php session_start(); ?>
<?php
    require_once 'auth.php';
    require_once 'config.php';
    require_once 'template.php';
    if(isset($_POST['integrate'])){
        $auth = new Auth(CLIENT_ID, CLIENT_SECRET, REDIRECT_URI, LOGIN_URI);
        $response = $auth->authorize();
    }
?>
<?php getHead() ?>
<h2> Sales Force API Connection App</h2>
<p>
    <?php if(session_id() != ''){
       echo $_SESSION['access_token'];
    }?>
</p>
<form method="POST" action="">

    <input type="submit" value="integrate" name="integrate"/> <span>show title here if they are integrated!</span>
</form>
<table>
    <thead>

    </thead>
    <tbody>

    </tbody>
</table>
<?php getFooter() ?>
