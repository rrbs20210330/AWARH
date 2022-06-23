<?php
include("components/header.php");
include('config/db.php');
//la  creacion para ver toda la informacion junta como reporte
$announcements = new db();
$announcements = $announcements->read_single_record('announcements',$_GET['id']);
$nombre = $announcements->name;
$descripcion = $announcements->description;
$fechadeinicio = $announcements->date_start;
$fechafinal = $announcements->date_finish;
$position = $announcements->position;
$Procedimiento = $announcements->process;
$Perfilsolicitado = $announcements->profile;
$funciones = $announcements->functions;
$estado = $announcements->active;
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
        <b>Cargo:</b> <?php echo $position ?><br>
        <b> Procedimeinto:</b> <?php echo $Perfilsolicitado?><br>
        <b>Perfil solicitado:</b> <?php echo $Procedimiento?><br>
        <b>Funciones:</b> <?php echo $funciones?><br>
        <b>Estado:</b> <?php echo $estado?><br>
      </div>
    </div>
  </div>
</div>



<?php
include("components/footer.php");
?>

