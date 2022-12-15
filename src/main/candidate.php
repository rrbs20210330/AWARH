<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
$candidate = $DataBase->read_single_record('candidate',$_GET['id']);
$id_cv = $candidate->id_cv;
$name = $candidate->name;
$phone_number = $candidate->phone_number;
$email = $candidate->email;
$appointment_date = $candidate->appointment_date;
$request_position = $candidate->request_position;
$perfil  = $candidate->perfil;
?>


<div class="container">
<div class="card-group">

<div class="card" >
  <center><div class="card-header">Informacion General</div></center>
  <div class="card-body">
    <h5 class="card-title">Informacion General</h5>
    <p class="card-text">
    Nombre Completo: <?php echo $name?><br>
    Email: <?php echo $email ?><br>
    Telefono: <?php echo $phone_number ?><br>
    
    
    <h5 class="card-title">Informacion del Candidato</h5>
    Posicion a ocupar: <?php echo $request_position?><br>
    Fecha de Cita: <?php echo $appointment_date?><br>
    Perfil: <?php echo $perfil?><br>
    </p>
    
  </div>
</div>


</div>
</div>
<br>


<?php
include("components/footer.php");
?>