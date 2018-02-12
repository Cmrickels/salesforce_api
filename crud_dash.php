<?php session_start();
require_once 'auth.php';
require_once 'config.php';
require_once 'template.php';
require_once 'Crud.php';
if(!isset($_SESSION['access_token'])){
    header('Location: '.SITE_URL);
}

if(isset($_GET)){
    $sf = new SalesForceCrud();
    if(isset($_GET['startDate']) && isset($_GET['startDate'])){
        $sf->getBetweenDates($_GET['startDate'], $_GET['startDate']);
    }

}
getHead()?>

<form action="" method="get">
    <input type="date" name="startDate">
    <input type="date" name="endDate">
    <input type="submit" value="Get Tasks" name="tasks-submit">
</form>
<form action="" method="get">
    <input type="date" name="startDate">
    <input type="date" name="endDate">
    <input type="submit" value="Get Tasks" name="accounts-submit">
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="custom.js"></script>
<?php getFooter() ?>

