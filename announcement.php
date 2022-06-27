<?php
include("components/header.php");
include('config/db.php');
//la  creacion para ver toda la informacion junta como reporte
$announcements = new db();
$announcement = $announcements->read_single_record_announcement($_GET['id']);
$nombre = $announcement->t_name;
$descripcion = $announcement->t_description;
$fechadeinicio = $announcement->d_date_start;
$fechafinal = $announcement->d_date_finish;
$Procedimiento = $announcement->t_process;
$Perfilsolicitado = $announcement->t_profile;
$funciones = $announcement->t_functions;
$estado = $announcement->b_active;
$file = $announcement->fk_file;
$path_file = $announcements->read_single_record_files($file)->t_path;;
?>
<br>

<div class="container">
  <div class="card-group">
    <div class="card" >
      <center><div class="card-header"><h3>Informe de la Convocatoria</h3> </div></center>
      <div class="card-body">
        <h5 class="card-title">Informacion General</h5>
        <p class="card-text">
        <b>Nombre de la convocatoria:</b> <?php echo $nombre?><br>
        <b>Descripcion de la convocatoria:</b> <?php echo $descripcion ?><br>
        <b> Fecha del inicio:</b> <?php echo $fechadeinicio?><br>
        <b>Fecha del Final:</b> <?php echo $fechafinal?><br>
        <b> Procedimeinto:</b> <?php echo $Perfilsolicitado?><br>
        <b>Perfil solicitado:</b> <?php echo $Procedimiento?><br>
        <b>Funciones:</b> <?php echo $funciones?><br>
        <b>Estado:</b> <?php echo $estado == 0 ? "Inactiva" : "Activa"?><br>
      </div>
    </div>
    <div class="card">
    <iframe src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$path_file ?>" width="" height="100%"></iframe>
    </div>
  </div>
</div>



<?php
include("components/footer.php");
?>

