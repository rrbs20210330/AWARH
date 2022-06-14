<?php include('components/header.php') ?>
<header>
  <link rel ="stylesheet" href="assets/css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
</header>
<body>
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
<div style="width:50%">
  <canvas id="grafica" width="1" height="1"></canvas>
</div>

<script>
  var grafica = document.getElementById("grafica");
  var myPirChart = new Chart(grafica,{
    type: 'pie',
    data: {
      labels: ['Empleados','Candidatos','Convocatorias'],
      datasets: [{
        label: "Reportes",
        data:[20,30,10],
        backgroundColor: ["#00ced1","#ee82ee","#ffa500"]
      }]
    },
  });
  </script>
  </body>
<?php include('components/footer.html') ?>