<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
$employee_info = $DataBase->read_info_employee($_GET['id']);
$employee = mysqli_fetch_object($employee_info);
$full_name = $employee->names." ".$employee->last_names;
$email = $employee->email;
$rfc = $employee->rfc;
$nss = $employee->nss;
$phone_number = $employee->phone_number;
$birthday = $employee->birthday;
$no_exterior = $employee->no_exterior;
$no_interior = $employee->no_interior;
$references = $employee->references;
$street = $employee->street;
$colony = $employee->colony;
$position = $employee->id_position;
$charge = $employee->id_charge;
?>


<div class="container">
<div class="card-group">


<div class="card" >
  <center><div class="card-header">Informacion de Empleado </div></center>
  <div class="card-body">
    <h5 class="card-title">Informacion General</h5>
    <p class="card-text">
    Nombre: <?php echo $full_name?><br>
    Email: <?php echo $email ?><br>
    RFC: <?php echo $rfc?><br>
    NSS: <?php echo $nss?><br>
    Telefono: <?php echo $phone_number ?><br>
    Fecha de Nacimiento: <?php echo $birthday?><br>
    
    <h5 class="card-title">Domicilio</h5>
    No. Exterior: <?php echo $no_exterior?><br>
    No. Interior: <?php echo $no_interior ?><br>
    Referencias: <?php echo $references ?><br>
    Calle: <?php echo $street?><br>
    Colonia: <?php echo $colony?><br>
    </p>
    
  </div>
</div>


</div>
</div>
<br>


<?php
include("components/footer.php");
?>

