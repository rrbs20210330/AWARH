<?php
include("components/header.php");
include('config/db.php');
//la  creacion para ver toda la informacion junta como reporte
$announcements = new db();
$announcements = $announcements->read_single_record('announcements',$_GET['id']);
$nombre = $announcements->nombre;
$descripcion = $announcements->descripcion;
$fechadeinicio = $announcements->fechadeinicio;
$fechafinal = $announcements->fechafinal;
$position = $announcements->position;
$Procedimiento = $announcements->Procedimiento;
$Perfilsolicitado = $announcements->Perfilsolicitado;
$funciones = $announcements->funciones;
?>


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

  </div>
</div>

</div>
</div>
<br>


<?php
include("components/footer.html");
?>

