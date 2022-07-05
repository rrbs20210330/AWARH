<?php include('components/header.php');
include('config/db.php');
$DataBase = new db();
if(intval($tipo) === 1){
  $pe = $DataBase->count_data_table('employees');
  $pt = $DataBase->count_data_table('trainings');
  $pa = $DataBase->count_data_table('announcements');
  $employees = $pe->count_data;
  $trainings = $pt->count_data;
  $announcements = $pa->count_data;
}else{
  $id_user = $_SESSION['id_usuario'];
  $id_employee = $DataBase->read_single_record_user_employee($id_user)->fk_employee;
  $employee_info = $DataBase->read_info_employee(intval($id_employee));
  $user_info = $DataBase->read_single_record_user($id_user);
  $id_area = $DataBase->read_single_record_area_position($employee_info->fk_position)->fk_area;
  $area_info = $DataBase->read_single_record_area($id_area);
  $count = $DataBase->count_data_training($id_employee);
} 
?>
<br>
<div class="container">
  <?php if(intval($tipo) === 1){ ?>
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
  <?php } else {?>
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <div class="col">  
        <div class="card card-body">
          <h2 class="card-title btn btn-dark"> Información General</h2>
          <div class="row row-cols-1 row-cols-md-2">
            <div class="col">
              <strong>Nombres:</strong> <?php echo $employee_info->t_names; ?> <br>
              <strong>Apellidos:</strong> <?php echo $employee_info->t_last_names; ?> <br>
              <strong>Email:</strong> <?php echo $employee_info->t_email; ?> <br>
              <strong>RFC:</strong> <?php echo $employee_info->t_rfc; ?> <br>
              <strong>NSS:</strong> <?php echo $employee_info->t_nss; ?> <br>
              <strong>Teléfono:</strong> <?php echo $employee_info->t_phone_number; ?> <br>
              <strong>Fecha de Nacimiento:</strong> <?php echo $employee_info->d_birthday; ?> <br>
              <strong>Fotografía:</strong> <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$DataBase->read_single_record_files($employee_info->fk_img)->t_path; ?>" target="_blank" rel="noopener noreferrer">Click Aqui</a> <br>
            </div>
            <div class="col">
              <strong>No. Exterior:</strong> <?php echo $employee_info->t_no_exterior; ?> <br>
              <strong>No. Interior:</strong> <?php echo $employee_info->t_no_interior; ?> <br>
              <strong>Calle:</strong> <?php echo $employee_info->t_street; ?> <br>
              <strong>Colonia:</strong> <?php echo $employee_info->t_colony; ?> <br>
              <strong>Referencias:</strong> <?php echo $employee_info->t_references; ?> 
            </div>
        </div>
        <div class="card-footer">
          <center><a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edicion"><i class="bi bi-exclamation-triangle-fill" ></i> Solicitar Actualización</a></center>
        </div>
      </div>
    </div>
    <div class="col">   
      <div class="card card-body">
        <h2 class="card-title btn btn-dark"> Información Institucional</h2>
        <div class="row row-cols-1 row-cols-md-2">
          <div class="col">
            <strong>Puesto:</strong> <?php echo $DataBase->read_single_record_position($employee_info->fk_position)->t_name; ?>  <br>
            <strong>Cargo:</strong> <?php echo $DataBase->read_single_record_charges($employee_info->fk_charge)->t_name; ?>  <br>
            <strong>Contrato:</strong> <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$DataBase->read_single_record_files($employee_info->fk_contract)->t_path; ?>" target="_blank" rel="noopener noreferrer">Click Aqui</a> <br>
            <strong>CV:</strong> <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$DataBase->read_single_record_files($employee_info->fk_cv)->t_path; ?>" target="_blank" rel="noopener noreferrer">Click Aqui</a> <br>
            <strong>Área:</strong> <?php echo $area_info->t_name ?> <br>
            <strong>Capacitaciones:</strong> <?php echo $count->count_data; ?> <br>
          </div>
          <div class="col">
            <strong>Usuario:</strong> <?php echo $user_info->t_user; ?> <br>
            <strong>Contraseña:</strong> <?php echo $user_info->t_password; ?> <br>
            <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editpassword"><i class="bi bi-exclamation-triangle-fill" ></i> Cambiar Contraseña</a>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<?php if(intval($tipo) === 2){ ?>
  <!-- FORMULARIO DE REGISTRO DE USUARIOS -->
  <div class="modal fade" id="edicion" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nuevo de Empleado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" action="process/new.php" id="formul" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <center><label for="">Contacto</label></center>
              <div class="col-sm-6">
                <label>Teléfono </label>
                <input type="number" class="form-control" id="phone_number" name="phone_number" required value="" minlength="10" onkeypress="return verificaNumeros(event);" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
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
    <!-- FORMULARIO DE REGISTRO DE USUARIOS -->
    <div class="modal fade" id="editpassword" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Contraseña</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" action="process/new.php" id="formul" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <center>
                <label>Nueva Contraseña </label>
                
                </center>
                <input type="text" class="form-control" name="password_new" required value="">
              </div>          
            </div>
            <input type="hidden" name="typeOp" value="3">
            <br>    
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" onclick="confirmSave()">Cambiar Contraseña</button>
          </div>
        </form>
      </div>
    </div>
  </div>    
<?php } ?>
<!-- <div style="width:50%">
  <canvas id="grafica" width="1" height="1"></canvas>
</div> -->
<script>
  function verificaNumeros(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}
  </script>
<?php include('components/footer.php') ?>