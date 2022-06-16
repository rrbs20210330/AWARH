<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
?>


<br/>
<button class="btn btn-success" onclick="functionUno()">Chargues</button>
<button class="btn btn-primary" onclick="functionDos()">Activities</button>
<button class="btn btn-dark" onclick="functionTres()">Positions</button>
<button class="btn btn-danger" onclick="functionCuatro()">Users</button>


<!-- DIV 1 CHARGUES --> 
<div id="div1" class="container-fluid">
<?php include('charges.php'); ?>
</div>


<!----------------- DIV 2 ACTIVITIES ------------------------> 
<div id="div2" class="container-fluid">
<?php include('activities.php'); ?>
</div>
<!----------------- DIV 3 POSITIONS ------------------------> 

<div id="div3" class="container-fluid">
<?php include('positions.php'); ?>

</div>


<div id="div4" class="container-fluid">

<?php  include('users.php');?>
</div>

<?php
include("components/footer.php");
?>