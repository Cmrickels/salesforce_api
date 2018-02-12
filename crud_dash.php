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
        $tasks = $sf->getBetweenDates($_GET['startDate'], $_GET['endDate']);
    }
    if(isset($_GET['name'])){
        $alert = $sf->create(array('Name'=>$_GET['name']));
    }
    if(isset($_GET['name-edit']) && isset($_GET['city']) && isset($_GET['id']) && isset($_GET['website'])){
        $alert = $sf->update($_GET['id'], array('Name'=>$_GET['name-edit'], 'BillingCity'=>$_GET['city'], 'Website'=>$_GET['website']));
    }
}
getHead()?>
<style>
    #all-purpose-table {
        table-layout: fixed;
        width: 100%;
        border-collapse: collapse;
        border: 3px solid purple;
    }
    #all-purpose-table thead, #all-purpose-table td{
        border:2px solid black;
        padding:10px;
    }
</style>
<?php if(!empty($alert)){ echo "<h4>Account with id: ".$alert['id']." was successfully created</h4>"; }?>
<form action="" method="get">
    <p>Get Tasks between two dates</p>
    <input type="date" name="startDate" required>
    <input type="date" name="endDate" required>
    <input type="submit" value="Get Tasks" name="tasks-submit">
</form>
<form action="" method="get">
    <p>Add account</p>
    <label for="name">Name</label>
    <input type="text" name="name" required>
    <input type="submit" value="Get Tasks" name="accounts-submit">
</form>
<form action="" method="get">
    <p>Update account</p>
    <label for="id">Id</label>
    <input type="text" name="id" required>
    <label for="name-edit">Name</label>
    <input type="text" name="name-edit" required>
    <label for="city">City</label>
    <input type="text" name="city" required>
    <label for="website">Website</label>
    <input type="text" name="website" required>
    <input type="submit" value="Get Tasks" name="accounts-edit-submit">
</form>

<?php if(isset($tasks)){ ?>
<table id="all-purpose-table">
    <thead>
    <th>Id</th>
    <th>Subject</th>
    <th>Priority</th>
    <th>Description</th>
    </thead>
    <tbody>
    <?php foreach($tasks as $task){
        echo "<tr>".
        "<td>".$task['Id']."</td>".
        "<td>".$task['Subject']."</td>".
        "<td>".$task['Priority']."</td>".
        "<td>".$task['Description']."</td>".
        "<td>".$task['CreatedDate']."</td>".
        "</tr>";
    }?>
    </tbody>
</table>
<?php } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="custom.js"></script>
<?php getFooter() ?>