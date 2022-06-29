<?php include('components/header.php');
include('config/db.php');
$DataBase = new db();
$pe = $DataBase->count_data_table('employees');
$pt = $DataBase->count_data_table('trainings');
$pa = $DataBase->count_data_table('announcements');
$employees = $pe->count_data;
$trainings = $pt->count_data;
$announcements = $pa->count_data;?>
<br>
  <div class="container">
<div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
      <div class="card text-bg-dark h-100">
        <center>
          <i class="fa-5x bi bi-person-circle"></i>
        </center>
        <div class="card-body">
            <h5 class="card-title">Empleados</h5>
            <p class="card-text">Cantidad de empleados: <?php echo $employees ?></p>
        </div>
        <a href="employees.php">
        <div class="card-footer">
          <small>Ver mas</small>
        </div>
        </a>
      </div>
    
  </div>
  <div class="col">
  
    <div class="card text-bg-dark h-100">
      <center>
      <i class="fa-5x bi bi-file-earmark-text-fill"></i>
</center>
      <div class="card-body">
        <h5 class="card-title">Capacitaciones</h5>
        <p class="card-text">Cantidad de capacitaciones: <?php echo $trainings ?></p>
      </div>
      <a href="trainings.php">
      <div class="card-footer">
        <small>Ver mas</small>
      </div>
      </a>
    </div>
    
  </div>
  <div class="col">
    <div class="card  text-bg-dark h-100">
      <center>
    <i class="fa-5x bi bi-file-earmark-image"></i>
</center>  
    <div class="card-body">
        <h5 class="card-title">Convocatorias</h5>
        <p class="card-text">Cantidad de convocatorias: <?php echo $announcements ?></p>
      </div>
      <a href="announcements.php">
      <div class="card-footer">
        <small>Ver mas</small>
      </div>
      </a>
    </div>
  </div>
</div>
<!-- <div style="width:50%">
  <canvas id="grafica" width="1" height="1"></canvas>
</div> -->

<?php include('components/footer.php') ?>