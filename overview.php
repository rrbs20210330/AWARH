<?php include('components/header.php') ?>
<br>
  <div class="container">
<div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <div class="card h-100">
      <center>
    <a href="employees.php"><i class="fa-5x bi bi-person-circle"></i></a>
</center>
    <div class="card-body">
        <h5 class="card-title">Empleados</h5>
        <p class="card-text">Cantidad de empleados:</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Ver mas</small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <center>
      <a href="training.php"><i class="fa-5x bi bi-person-bounding-box"></i></a>
</center>
      <div class="card-body">
        <h5 class="card-title">Capacitaciones</h5>
        <p class="card-text">Cantidad de capacitaciones:</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Ver mas</small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <center>
    <a href="announcements.php"><i class="fa-5x bi bi-file-earmark-image"></i></a>
</center>  
    <div class="card-body">
        <h5 class="card-title">Convocatorias</h5>
        <p class="card-text">Cantidad de convocatorias</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Ver mas</small>
      </div>
    </div>
  </div>
</div>
<!-- <div style="width:50%">
  <canvas id="grafica" width="1" height="1"></canvas>
</div> -->

<?php include('components/footer.php') ?>