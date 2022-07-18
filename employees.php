<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
if($tipo === 2)header('Location: error.php');
require('process/new.php');
require('process/delete.php');
require('process/update.php');
?>

<center><h2>Lista de Empleados</h2></center>

<div class="container">
<abbr title="Nuevo empleado"><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#registroempleado">
<i style='font-size:24px' class="bi bi-person-fill"><span class="glyphicon">&#x2b;</span></i>
</button></abbr>
<br><br>
    <table class="table table-striped table-bordered userTable" style='background: #00252e '>
        <thead style="color: white"> 
            <th>Estado</th>
            <th>Nombre Completo</th>
            <th>Teléfono</th>
            <th>Correo Electrónico</th>
            <th></th>
            
        </thead>
        <tbody>
            <?php 
                $l_employees = $DataBase->read_all_employees();
                while ($row = mysqli_fetch_object($l_employees)) {
                    $id = $row->id_employee;
                    $active = $row->b_active;
                    $fullname = $row->t_names." ".$row->t_last_names;
                    $email = $row->t_email;
                    $phone_number = $row->t_phone_number;
                    $id_user = $DataBase->read_single_record_employee_user($id)->fk_user;
            ?>
            <tr>
                <td>
                    <form method="post">
                    <input type="hidden" name="update" value="1">
                    <input type="hidden" name="typeOp" value="11">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="hidden" name="idu" value="<?php echo $id_user ?>">
                    <?php if ($active == 0){
                      ?>
                    <button type="submit"class="btn btn-secondary btn-sm"><i class="bi bi-eye-slash-fill"></i></button>
                    <?php

                    }else{?>
                    <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-eye-fill"></i></button>
                    <?php
                    }?>
                    
                    </form>
                </td>
                <td>
                    <?php echo $fullname ?>
                </td>
                <td>
                    <?php echo $phone_number ?>
                </td>
                <td>
                    <?php echo $email ?>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditEmployee-<?php echo $id ?>" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm " data-bs-toggle="modal" data-bs-target="#DeleteEmployee-<?php echo $id ?>"><i class="bi-trash"></i></a>
                    <a class="btn btn-dark btn-sm " data-bs-toggle="modal" data-bs-target="#SeeInfoEmployee-<?php echo $id ?>"><i class="bi bi-eye"></i></a>
                    
                </td>
            </tr>  
            <?php }?>
        </tbody>
    </table>
</div>

<!-- FORMULARIO DE REGISTRO DE USUARIOS -->
<div class="modal fade" id="registroempleado" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registro de Empleados</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form method="post"  id="formul" enctype="multipart/form-data" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
          <center><label for="">Información General</label></center>
            <div class="row">
                
                <div class="col-sm-4">
                <label>Nombres </label>
                <input type="text" class="form-control" id="names" name="names" required value="">
                </div>
                <div class="col-sm-4">
                <label >Apellidos</label>
                <input type="text" class="form-control" id="last_names" name="last_names" required>
                </div>    
                <div class="col-sm-4">
                <label >F. de Nacimiento</label>
                <input type="date" class="form-control" id="birthday" name="birthday" required>
                </div>       
                <div class="col-sm-4">
                <label >Fotografía</label>
                <input type="file" class="form-control" id="photo[]" name="photo[]" required>
                </div>
                <div class="col-sm-4">
                <label >RFC</label>
                <input type="text" class="form-control" id="rfc" name="rfc" required>
                </div>
                <div class="col-sm-4">
                <label >NSS</label>
                <input type="text" class="form-control" id="nss" name="nss" required>
                </div>
            </div>
            <br> 
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
                <div class="col-sm-4">
                <label >Colonia</label>
                <input type="text" class="form-control" id="colony" name="colony" required>
                </div>
                <div class="col-sm-8">
                <label>Referencias</label>
                <textarea class="form-control" name="references" id="references" rows="1" required></textarea>
                
                </div>
            </div>
            <br> 
            <div class="row">
                <center><label for="">Información de trabajo</label></center>
                <div class="col-sm-6">
                <label>Cargo</label>
                <select class="form-select" aria-label="Default select example" id="charge" name="charge" required>
                <?php     
                            $l_charges_select = $DataBase->read_data_table('charges');
                            if(mysqli_num_rows($l_charges_select) === 0 ) { ?>
                            <option selected disabled value="">Necesitas crear un cargo primero</option>
                            <?php } else { ?> <option selected disabled value="">Selecciona un Cargo</option><?php } ?>
                            <?php 
                        while ($row = mysqli_fetch_object($l_charges_select)) {
                            $id = $row->id_charge;
                            $name = $row->t_name;
                            ?>
                    <option value="<?php echo $id ?>"><?php echo $name ?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="col-sm-6">
                    <label for="">Puesto</label>
                    <select class="form-select" aria-label="Default select example" id="position" name="position" required>
                    <?php     
                            $l_positions_select = $DataBase->read_data_table('positions');
                            if(mysqli_num_rows($l_positions_select) === 0 ) { ?>
                            <option selected disabled value="">Necesitas crear un puesto primero</option>
                            <?php } else { ?> <option selected disabled value="">Selecciona un Puesto</option><?php } ?>
                            <?php 
                            while ($row = mysqli_fetch_object($l_positions_select)) {
                                $id = $row->id_position;
                                $name = $row->t_name;
                                $area_id = $DataBase->read_single_record_positions_areas($id) ? $DataBase->read_single_record_positions_areas($id)->fk_position : 0;
                                $area = $area_id == 0 ? "Ninguna" : ($DataBase->read_single_record_area($area_id) ? $DataBase->read_single_record_area($area_id)->t_name : "Ninguna");?>
                                ?>
                        <option value="<?php echo $id ?>"><?php echo $name." - ".$area ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-6">
                <label>Contrato</label>
                <input type="file" class="form-control" id="contract[]" name="contract[]" required>
                </div>
                <div class="col-sm-6">
                <label>CV</label>
                <input type="file" class="form-control" id="cv[]" name="cv[]" required>
                </div>
            </div>
            <input type="hidden" name="typeOp" value="3">
            <input type="hidden" name="new" value="1">
            <br>    
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" >Registrar</button>
          </div>
          </form>
        </div>
      </div>
    </div>    
    
    






<?php 
    $l_employees = $DataBase->read_all_employees();
    while ($row = mysqli_fetch_object($l_employees)) {
        $idL = $row->id_employee;
        $employee = $DataBase->read_info_employee($idL);
        $names = $employee->t_names;
        $last_names = $employee->t_last_names;
        $email = $employee->t_email;
        $rfc = $employee->t_rfc;
        $nss = $employee->t_nss;
        $phone_number = $employee->t_phone_number;
        $birthday = $employee->d_birthday;
        $no_exterior = $employee->t_no_exterior;
        $no_interior = $employee->t_no_interior;
        $references = $employee->t_references;
        $street = $employee->t_street;
        $colony = $employee->t_colony;
        $position = $employee->fk_position;
        $charge = $employee->fk_charge; 
?>
    <!-- FORMULARIO DE EDICION DE USUARIOS -->
    <div class="modal fade" id="EditEmployee-<?php echo $idL ?>" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edición de Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="post"  id="formul" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
            <center><label for="">Información General</label></center>
                <div class="row">
                    
                    <div class="col-sm-4">
                    <label>Nombres </label>
                    <input value="<?php echo $names?>" type="text" class="form-control" id="names" name="names">
                    </div>
                    <div class="col-sm-4">
                    <label >Apellidos</label>
                    <input value="<?php echo $last_names?>" type="text" class="form-control" id="last_names" name="last_names" >
                    </div>    
                    <div class="col-sm-4">
                    <label >F. de Nacimiento</label>
                    <input value="<?php echo $birthday?>"type="date" class="form-control" id="birthday" name="birthday" >
                    </div>       
                    <div class="col-sm-4">
                    <label >Fotografía</label>
                    <input type="file" disabled class="form-control" id="photo" name="photo" data-bs-toggle="tooltip" data-bs-placement="top" title="No se puede editar el archivo">
                    </div>
                    <div class="col-sm-4">
                    <label >RFC</label>
                    <input value="<?php echo $rfc?>" type="text" class="form-control" id="rfc" name="rfc" >
                    </div>
                    <div class="col-sm-4">
                    <label >NSS</label>
                    <input value="<?php echo $nss?>" type="text" class="form-control" id="nss" name="nss" >
                    </div>
                </div>
                <br> 
                <div class="row">
                    <center><label for="">Contacto</label></center>
                    <div class="col-sm-6">
                    <label>Teléfono </label>
                    <input value="<?php echo $phone_number?>" type="number" class="form-control" id="phone_number" name="phone_number" minlength="10" onkeypress="return verificaNumeros(event);" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                    <div class="col-sm-6">
                    <label >Correo Electronico</label>
                    <input value="<?php echo $email?>" type="email" class="form-control" id="email" name="email" >
                    </div>           
                </div>
                <br> 
                <div class="row">
                    <center><label for="">Domicilio</label></center>
                    <div class="col-sm-4">
                    <label>Calle</label>
                    <input value="<?php echo $street?>"type="text" class="form-control" id="street" name="street" >
                    </div>
                    <div class="col-sm-4">
                    <label>Número Exterior</label>
                    <input value="<?php echo $no_exterior?>" type="number" class="form-control" id="no_exterior" name="no_exterior" >
                    </div>
                    <div class="col-sm-4">
                    <label >Número Interior</label>
                    <input value="<?php echo $no_interior?>" type="number" class="form-control" id="no_interior" name="no_interior" >
                    </div>
                    <div class="col-sm-4">
                    <label >Colonia</label>
                    <input value="<?php echo $colony?>" type="text" class="form-control" id="colony" name="colony" >
                    </div>
                    <div class="col-sm-8">
                    <label>Referencias</label>
                    <textarea class="form-control" name="references" id="references" rows="1" required><?php echo $references?></textarea>
                    
                    </div>
                </div>
                <br> 
                <div class="row">
                    <center><label for="">Información de trabajo</label></center>
                    <div class="col-sm-6">
                    <label>Cargo</label>
                    <select class="form-select" aria-label="Default select example" id="charge" name="charge" required>
                    <?php     
                            $l_charges_select = $DataBase->read_data_table('charges');
                            if(mysqli_num_rows($l_charges_select) === 0 ) { ?>
                            <option selected disabled value="">Necesitas crear un cargo primero</option>
                            <?php } else { ?> <option <?php if(intval($charge) === 0){?> selected <?php }?> disabled value="">Selecciona un Cargo</option><?php } ?>
                            <?php 
                            while ($row = mysqli_fetch_object($l_charges_select)) {
                                $idc = $row->id_charge;
                                $namec = $row->t_name;
                                ?>
                        <option value="<?php echo $idc ?>" <?php if($idc == $charge){?> selected <?php }?>><?php echo $namec ?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Puesto</label>
                        <select class="form-select" aria-label="Default select example" id="position" name="position" required>
                        <?php     
                            $l_positions_select = $DataBase->read_data_table('positions');
                            if(mysqli_num_rows($l_positions_select) === 0 ) { ?>
                            <option selected disabled value="">Necesitas crear un puesto primero</option>
                            <?php } else { ?> <option <?php if(intval($position) === 0){?> selected <?php }?> disabled value="">Selecciona un Puesto</option><?php } ?>
                            <?php 
                                while ($row = mysqli_fetch_object($l_positions_select)) {
                                    $idp = $row->id_position;
                                    $namep = $row->t_name;
                                    $area_id = $DataBase->read_single_record_positions_areas($id) ? $DataBase->read_single_record_positions_areas($id)->fk_position : 0;
                                    $area = $area_id == 0 ? "Ninguna" : ($DataBase->read_single_record_area($area_id) ? $DataBase->read_single_record_area($area_id)->t_name : "Ninguna");
                                    ?>
                            <option value="<?php echo $idp ?>" <?php if($idp == $position){?> selected <?php }?>><?php echo $namep." - ".$area ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                    <label>Contrato</label>
                    <input type="file" disabled class="form-control" id="contract" name="contract" data-bs-toggle="tooltip" data-bs-placement="top" title="No se puede editar el archivo">
                    </div>
                    <div class="col-sm-6">
                    <label>CV</label>
                    <input type="file" disabled class="form-control" id="cv" name="cv" data-bs-toggle="tooltip" data-bs-placement="top" title="No se puede editar el archivo">
                    </div>
                </div>
                <input type="hidden" name="typeOp" value="4">
                <input type="hidden" name="id" value="<?php echo $idL ?>">
                <input type="hidden" name="update" value="1">
                <br>    
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" >Editar</button>
            </div>
            </form>
            </div>
        </div>
    </div>    
<?php } ?>


<?php 
  $l_employees = $DataBase->read_data_table('employees');
  while ($row = mysqli_fetch_object($l_employees)) {
    $id = $row->id_employee;
?>
  <!-- Modal Delete-->
  <div class="modal fade" id="DeleteEmployee-<?php echo $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">¿Estás Seguro?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          El dato será eliminado y no podrá ser recuperado.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <form method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <input type="hidden" name="typeOp" id="typeOp" value="4">
            <input type="hidden" name="delete" value="1">
            <button type="submit" class="btn btn-danger">Sí, borrar ahora!</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>





<?php 
    $l_employees = $DataBase->read_all_employees();
    while ($row = mysqli_fetch_object($l_employees)) {
        $idL = $row->id_employee;
        $employee_info = $DataBase->read_info_employee(intval($idL));
        $puesto = $employee_info->fk_position === null ? "Ninguno" : ($DataBase->read_single_record_position($employee_info->fk_position)->b_deleted == 1 ? "Ninguno" : $DataBase->read_single_record_position($employee_info->fk_position)->t_name);
        $cargo = $employee_info->fk_charge === null ? "Ninguno" : ($DataBase->read_single_record_charges($employee_info->fk_charge)->b_deleted == 1 ? "Ninguno" : $DataBase->read_single_record_charges($employee_info->fk_charge)->t_name);
        $id_area = $employee_info->fk_position == null ? null : ($DataBase->read_single_record_area_position($employee_info->fk_position) ? $DataBase->read_single_record_area_position($employee_info->fk_position)->fk_area : null);
        $area = $id_area == null ? "Ninguna" : $DataBase->read_single_record_area($id_area)->t_name;
        $path_p = $DataBase->read_single_record_files($employee_info->fk_img)->t_path;
        $id_user = $DataBase->read_single_record_employee_user($idL)->fk_user;
        $user_info = $DataBase->read_single_record_user($id_user);
        $count = $DataBase->count_data_training($idL); 
?>      
    <!-- FORMULARIO DE EDICION DE USUARIOS -->
    <div class="modal fade" id="SeeInfoEmployee-<?php echo $idL ?>" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información del Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col">
                        <center><label for="">Información General</label></center>
                        <p>
                            <strong>Nombre:</strong> <?php echo $employee_info->t_names." ".$employee_info->t_last_names?><br>
                            <strong>Email:</strong> <?php echo $employee_info->t_email; ?><br>
                            <strong>RFC:</strong> <?php echo $employee_info->t_rfc?><br>
                            <strong>NSS:</strong> <?php echo $employee_info->t_nss?><br>
                            <strong>Teléfono:</strong> <?php echo $employee_info->t_phone_number ?><br>
                            <strong>Fecha de Nacimiento:</strong> <?php echo $employee_info->d_birthday?><br>
                            <strong>No. Exterior:</strong> <?php echo $employee_info->t_no_exterior?><br>
                            <strong>No. Interior:</strong> <?php echo $employee_info->t_no_interior ?><br>
                            <strong>Referencias:</strong> <?php echo $employee_info->t_references ?><br>
                            <strong>Calle:</strong> <?php echo $employee_info->t_street?><br>
                            <strong>Colonia:</strong> <?php echo $employee_info->t_colony?><br>
                            <strong>Fotografía:</strong> <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$path_p ?>" target="_blank" rel="noopener noreferrer">Click Aqui</a> <br>
                        </p>    
                    </div>
                    <div class="col">
                        <center><label for="">Información Institucional</label></center>
                        <p>
                            <strong>Puesto:</strong> <?php echo $puesto ?>  <br>
                            <strong>Cargo:</strong> <?php echo $cargo ?>  <br>
                            <strong>Contrato:</strong> <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$DataBase->read_single_record_files($employee_info->fk_contract)->t_path; ?>" target="_blank" rel="noopener noreferrer">Click Aqui</a> <br>
                            <strong>CV:</strong> <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$DataBase->read_single_record_files($employee_info->fk_cv)->t_path; ?>" target="_blank" rel="noopener noreferrer">Click Aqui</a> <br>
                            <strong>Área:</strong> <?php echo $area ?> <br>
                            <strong>Usuario:</strong> <?php echo $user_info->t_user; ?> <br>
                            <strong>Contraseña:</strong> <?php echo $user_info->t_password; ?> <br>
                            <strong>Capacitaciones:</strong> <?php echo $count->count_data; ?> <button class="btn btn-success btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Ver mas
                                </button>
                        </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <ul class="list-group">
                                        <?php $l_training = $DataBase->read_data_table_employees_trainings($idL);
                                        while($row = mysqli_fetch_object($l_training)){
                                        $id_training = $row->fk_training;
                                        $infotrain = $DataBase->read_single_record_training($id_training);
                                        ?>
                                        <li class="list-group-item"><?php echo $infotrain->t_name; ?></li>
                                        <?php } ?>
                                    </ul> 
                                </div> 
                            </div>               
                        </p>  
                    </div> 
                </div>                 
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
            </div>
            </div>
        </div>
    </div>    
<?php } ?>
<script>
  function verificaNumeros(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}
var elemento = document.getElementById('employee_list');
elemento.classList.add("active");
  </script>
<?php 
include("components/footer.php");
?>

