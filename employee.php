<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
$employee_info = $DataBase->read_info_employee($_GET['id']);
$employee = mysqli_fetch_object($employee_info);
$full_name = $employee->t_names." ".$employee->t_last_names;
$email = $employee->t_email;
$rfc = $employee->t_rfc;
$nss = $employee->t_nss;
$phone_number = $employee->t_phone_number;
$birthday = $employee->d_birthday;
$no_exterior = $employee->t_no_exterior;
$no_interior = $employee->t_no_interior;
$references = $employee->t_references;
$street = $employee->t_street;
$colony = $employee->t_colony;
$position = $employee->fk_position;
$charge = $employee->fk_charge;
$photo = $employee->fk_img;
$contract = $employee->fk_contract;
$path_c = $DataBase->read_single_record_files($contract)->t_path;
$path_p = $DataBase->read_single_record_files($photo)->t_path;
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
    <div class="card">
      <iframe src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$path_c ?>" width="" height="100%"></iframe>
    </div>
    <div class="card">
      <iframe src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$path_p ?>" width="" height="100%"></iframe>
    </div>

  </div>
</div>
<br>


<?php
include("components/footer.php");
?>

