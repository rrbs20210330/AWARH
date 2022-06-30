<?php include('components/header-user.php');
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
<div class="row row-cols-1 row-cols-md-2 g-4">
  <div class="col">  
  <div class="card card-body">
    <h2 class="card-title btn btn-dark"> Información General</h2>
    <div class="row row-cols-1 row-cols-md-2">
      <div class="col">
        <strong>Nombres:</strong> Roberto Ramses <br>
        <strong>Apellidos:</strong> Bueno Siller <br>
        <strong>Email:</strong> a20210330@utem.edu.mx <br>
        <strong>RFC:</strong> GEC8501014I5 <br>
        <strong>NSS:</strong> 72795608040 <br>
        <strong>Teléfono:</strong> 3141092271 <br>
        <strong>Fecha de Nacimiento:</strong> 1986-06-05 <br>
        <strong>Fotografía:</strong> Click Aqui
        
      </div>
      <div class="col">
        <strong>No. Exterior:</strong> 504 <br>
        <strong>No. Interior:</strong> 504 <br>
        <strong>Calle:</strong> Callao <br>
        <strong>Colonia:</strong> Colonial <br>
        <strong>Referencias:</strong> una casa, muy bonita pero muy muy lejana, asi a la lejania bien lejana al lado de algun lugar donde aparecen arboles, si, muchos arboles. 
      </div>
    </div>
    <div class="card-footer"><a class="btn btn-warning"><i class="bi bi-exclamation-triangle-fill"></i> Solicitar Actualización</a></div>
  </div>
</div>
  
  <div class="col">   
    <div class="card card-body">
      <h2 class="card-title btn btn-dark"> Información Institucional</h2>
      <div class="row row-cols-1 row-cols-md-2">
        <div class="col">
          <strong>Puesto:</strong> PTC <br>
          <strong>Cargo:</strong> PTC Asociado A <br>
          <strong>Contrato:</strong> Click Aqui <br>
          <strong>CV:</strong> Click Aqui <br>
          <strong>Área:</strong> TICS <br>
          <strong>Capacitaciones:</strong> 198 <br>
          
        </div>
        <div class="col">
          <strong>Usuario:</strong> GEC8501014I5 <br>
          <strong>Contraseña:</strong> 72795608040 <br>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- <div style="width:50%">
  <canvas id="grafica" width="1" height="1"></canvas>
</div> -->

<?php include('components/footer.php') ?>