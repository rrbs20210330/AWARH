<?php
include("components/header.php");
include('config/db.php');
//la  creacion para ver toda la informacion junta como reporte
$DataBase = new db();
$training = $DataBase->read_single_record('training',$_GET['id']);
$nombre = $training->name;
$descripcion = $training->description;
$date_realization = $training->date_realization;

?>
<br>

<div class="container">
  <div class="card-group">
    <div class="card" >
      <center><div class="card-header"><h3>Informe de la capacitacion</h3> </div></center>
      <div class="card-body">
        <h5 class="card-title">Informacion General</h5>
        <p class="card-text">
        <b>Nombre de la capacitacion:</b> <?php echo $nombre?><br>
        <b>Descripcion de la capacitacion:</b> <?php echo $descripcion ?><br>
        <b> Fecha de realización:</b> <?php echo $date_realization?><br>
      </div>
    </div>
  </div>
</div>



<?php
include("components/footer.php");
?>

