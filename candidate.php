<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
$candidate = $DataBase->read_single_record_candidates($_GET['id']);
$id_cv = $candidate->fk_cv;
$name = $candidate->t_name;
$phone_number = $candidate->t_phone_number;
$email = $candidate->t_email;
$appointment_date = $candidate->dt_appointment_date;
$request_position = $candidate->fk_request_position;
$perfil  = $candidate->t_profile;

$path_cv = $DataBase->read_single_record_files($id_cv)->t_path;
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
    
    <div class="card">
      <iframe src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$path_cv ?>" width="" height="100%"></iframe>
    </div>
  </div>  
</div>
<br>


<?php
include("components/footer.php");
?>