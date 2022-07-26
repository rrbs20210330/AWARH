<?php include('components/header.php');
$DataBase = new db();
if($tipo === 1){
  $pe = $DataBase->count_data_table('employees');
  $pt = $DataBase->count_data_table('trainings');
  $pa = $DataBase->count_data_table('announcements');
  $employees = $pe->count_data;
  $trainings = $pt->count_data;
  $announcements = $pa->count_data;
  require('process/new.php');
  require('process/delete.php');
  require('process/update.php');
}else{
  $id_employee = $DataBase->read_single_record_user_employee($id_usuario)->fk_employee;
  $employee_info = $DataBase->read_info_employee(intval($id_employee));
  $user_info = $DataBase->read_single_record_user($id_usuario);
  $id_area = $employee_info->fk_position !== null ? ($DataBase->read_single_record_area_position($employee_info->fk_position) ? $DataBase->read_single_record_area_position($employee_info->fk_position)->fk_area : null) : null;
  $area_info = $id_area !== null ? $DataBase->read_single_record_area($id_area)->t_name : "Ninguna";
  $puesto = $employee_info->fk_position === null ? "Ninguno" : ($DataBase->read_single_record_position($employee_info->fk_position)->b_deleted == 1 ? "Ninguno" : $DataBase->read_single_record_position($employee_info->fk_position)->t_name);
  $cargo = $employee_info->fk_charge === null ? "Ninguno" : ($DataBase->read_single_record_charges($employee_info->fk_charge)->b_deleted == 1 ? "Ninguno" : $DataBase->read_single_record_charges($employee_info->fk_charge)->t_name);
  $count = $DataBase->count_data_training($id_employee);
  $request = $DataBase->read_single_record_request_edit_data($id_employee) ? false : true;
  require('process/update.php');
  require('process/new.php');
} 
if($tipo == 1){?>
<head>
<link rel="stylesheet" href="assets/css/cards.css">
</head>
<?php }?>
<br>
<div class="container">
  <?php if($tipo === 1){ ?>
    <div class="card">
      <div class="box">
        <div class="content">
  
            <i class="fa-5x bi bi-person-circle"></i>
          <div class="card-body">
              <h5 class="card-title">Empleados</h5>
              <p class="card-text">No. de empleados: <?php echo $employees ?></p>
          </div>
          <a href="employees.php">
          <div class="card-footer">
            <small>Ver mas</small>
          </div>
          </a>  
        </div>
      </div>
  </div>
      <div class="card">
      <div class="box">
        <div class="content">
          <center>
            <i class="fa-5x bi bi-file-earmark-text-fill"></i>
          </center>
          <div class="card-body">
            <h5 class="card-title">Capacitaciones</h5>
            <p class="card-text">No. de capacitaciones: <?php echo $trainings ?></p>
          </div>
          <a href="trainings.php">
            <div class="card-footer">
              <small>Ver mas</small>
            </div>
          </a>
        </div>
      </div>
  </div>
  <div class="card">
      <div class="box">
        <div class="content">
          <center>
            <i class="fa-5x bi bi-file-earmark-image"></i>
          </center>  
          <div class="card-body">
            <h5 class="card-title">Convocatorias</h5>
            <p class="card-text">No. de convocatorias: <?php echo $announcements ?></p>
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
          <center>
            <button <?php if(!$request){?> disabled <?php }?> class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edicion">
              <i class="bi bi-exclamation-triangle-fill"></i> Solicitar Actualización
            </button>
            <?php if(!$request){?> Infó <?php }?>
          </center>
        </div>
      </div>
    </div>
    <div class="col">   
      <div class="card card-body">
        <h2 class="card-title btn btn-dark"> Información Institucional</h2>
        <div class="row row-cols-1 row-cols-md-2">
          <div class="col">
            <strong>Puesto:</strong> <?php echo $puesto; ?>  <br>
            <strong>Cargo:</strong> <?php echo $cargo; ?>  <br>
            <strong>Contrato:</strong> <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$DataBase->read_single_record_files($employee_info->fk_contract)->t_path; ?>" target="_blank" rel="noopener noreferrer">Click Aqui</a> <br>
            <strong>CV:</strong> <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$DataBase->read_single_record_files($employee_info->fk_cv)->t_path; ?>" target="_blank" rel="noopener noreferrer">Click Aqui</a> <br>
            <strong>Área:</strong> <?php echo $area_info ?> <br>
            <strong>Capacitaciones:</strong> <?php echo $count->count_data; ?> <br>
          </div>
          <div class="col">
            <strong>Usuario:</strong> <?php echo $user_info->t_user; ?> <br>
            <strong>Contraseña:</strong> <?php echo $user_info->t_password; ?> <br>
            <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editpassword<?php echo $id_usuario ?>"><i class="bi bi-exclamation-triangle-fill" ></i> Cambiar Contraseña</a>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<?php if($tipo === 2){ ?>
  <!-- FORMULARIO DE REGISTRO DE USUARIOS -->
  <div class="modal fade" id="edicion" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Información</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" id="formul" enctype="multipart/form-data" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
          <div class="modal-body">
            <div class="row">
              <center><label for="">Contacto</label></center>
              <div class="col-sm-6">
                <label>Teléfono </label>
                <input type="number" class="form-control" id="phone_number" name="phone_number" required value="<?php echo $employee_info->t_phone_number ?>" min="1111111111" onkeypress="return verificaNumeros(event);" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
              </div>
              <div class="col-sm-6">
                <label >Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $employee_info->t_email ?>" required>
              </div>           
            </div>
            <br> 
            <div class="row">
              <center><label for="">Domicilio</label></center>
              <div class="col-sm-4">
                <label>Calle</label>
                <input type="text" class="form-control" id="street" name="street" required value="<?php echo $employee_info->t_street ?>">
              </div>
              <div class="col-sm-4">
                <label>Número Exterior</label>
                <input type="text" class="form-control" id="no_exterior" value="<?php echo $employee_info->t_no_exterior ?>" name="no_exterior" required onkeypress="return verificaNumeros(event);" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
              </div>
              <div class="col-sm-4">
                <label >Número Interior</label>
                <input type="text" class="form-control" id="no_interior" value="<?php echo $employee_info->t_no_interior ?>" name="no_interior" required onkeypress="return verificaNumeros(event);" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
              </div>
              <div class="col-sm-4">
                <label >Colonia</label>
                <input type="text" class="form-control" id="colony" name="colony" required value="<?php echo $employee_info->t_colony ?>">
              </div>
              <div class="col-sm-8">
                <label>Referencias</label>
                <textarea class="form-control" name="references" id="references" cols="30" rows="1"><?php echo $employee_info->t_references ?></textarea>
              </div>
            </div>
            <input type="hidden" name="typeOp" value="12">
            <input type="hidden" name="new">
            <input type="hidden" name="id" value="<?php echo $id_employee?>">
            <br>    
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" >Solicitar</button>
          </div>
        </form>
      </div>
    </div>
  </div>  
    <!-- FORMULARIO DE CAMBIAR CONTRASEñA DE USUARIOS -->
    <?php 
  $l_password = $DataBase->read_data_table('users');
  while ($row = mysqli_fetch_object($l_password)) {
    $id = $row->id_user;
    $passwrd = $row->t_password;
?>
    <div class="modal fade" id="editpassword<?php echo $id ?>" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Contraseña</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" id="formul" enctype="multipart/form-data" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                <label>Nueva Contraseña </label>
                <input type="text" class="form-control" name="password" required value="<?php echo $passwrd?>">
              </div>          
            </div>
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="typeOp" value="10">
            <input type="hidden" name="update" value="1">
            <br>    
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" >Cambiar Contraseña</button>
          </div>
        </form>
      </div>
    </div>
  </div> 
  <?php } ?>   
<?php } ?>
<!-- <div style="width:50%">
  <canvas id="grafica" width="1" height="1"></canvas>
</div> -->
<script>
  function verificaNumeros(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}
var elemento = document.getElementById('overview_list');
elemento.classList.add("active");
  </script>
<?php include('components/footer.php') ?>