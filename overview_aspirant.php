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
    <div class="card-footer"><center><a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edicion"><i class="bi bi-exclamation-triangle-fill" ></i> Solicitar Actualización</a></center></div>
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
          <strong>Contraseña:</strong> **********8040 <br>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- <div style="width:50%">
  <canvas id="grafica" width="1" height="1"></canvas>
</div> -->


<!-- FORMULARIO DE REGISTRO DE USUARIOS -->
<div class="modal fade" id="edicion" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo de Empleado</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form method="post" action="process/new.php" id="formul" enctype="multipart/form-data">
            <div class="row">
                <center><label for="">Contacto</label></center>
                <div class="col-sm-6">
                <label>Teléfono </label>
                <input type="number" class="form-control" id="phone_number" name="phone_number" required value="">
                </div>
                <div class="col-sm-6">
                <label >Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
                </div>           
            </div>
            <br> 
            <div class="row">
                <center><label for="">Domicilio</label></center>
                <div class="col-sm-4">
                <label>Calle</label>
                <input type="text" class="form-control" id="street" name="street" required value="">
                </div>
                <div class="col-sm-4">
                <label>Número Exterior</label>
                <input type="number" class="form-control" id="no_exterior" name="no_exterior" required>
                </div>
                <div class="col-sm-4">
                <label >Número Interior</label>
                <input type="number" class="form-control" id="no_interior" name="no_interior" required>
                </div>
                <div class="col-sm-6">
                <label >Colonia</label>
                <input type="text" class="form-control" id="colony" name="colony" required>
                </div>
                <div class="col-sm-6">
                <label>Referencias</label>
                <textarea class="form-control" name="references" id="references" cols="30" rows="1"></textarea>
                
                </div>
            </div>
            <input type="hidden" name="typeOp" value="3">
            <br>    
          </div>
          <div class="modal-footer">
            
            <button type="submit" class="btn btn-success" onclick="confirmSave()">Registrar</button>
          </div>
          </form>
        </div>
      </div>
    </div>    
    

<?php include('components/footer.php') ?>


