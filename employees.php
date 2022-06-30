<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
?>

<center><h2>Lista de Empleados</h2></center>

<div class="container">
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#registroempleado">
  Nuevo Empleado
</button>
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
            ?>
            <tr>
                <td>
                    <?php if ($active == 0){
                      ?>
                    <a class="btn btn-secondary btn-sm" href="process/update.php?id=<?php echo $id?>&table=employees&location=employees&typeOp=1"><i class="bi bi-eye-slash-fill"></i></a>
                    <?php

                    }else{?>
                    <a class="btn btn-success btn-sm" href="process/update.php?id=<?php echo $id?>&table=employees&location=employees&typeOp=1"><i class="bi bi-eye-fill"></i></a>
                    <?php
                    }?>
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
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo de Empleado</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form method="post" action="process/new.php" id="formul" enctype="multipart/form-data">
          <center><label for="">Informacion General</label></center>
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
                <div class="col-sm-4">
                <label >Colonia</label>
                <input type="text" class="form-control" id="colony" name="colony" required>
                </div>
                <div class="col-sm-6">
                <label>Referencias</label>
                <textarea class="form-control" name="references" id="references" cols="30" rows="1"></textarea>
                
                </div>
            </div>
            <br> 
            <div class="row">
                <center><label for="">Información de trabajo</label></center>
                <div class="col-sm-4">
                <label>Cargo</label>
                <select class="form-select" aria-label="Default select example" id="charge" name="charge">
                    <option selected disabled value="">Selecciona una área</option>
                    <?php     
                        $l_charges_select = $DataBase->read_data_table('charges');
                        while ($row = mysqli_fetch_object($l_charges_select)) {
                            $id = $row->id_charge;
                            $name = $row->t_name;
                            ?>
                    <option value="<?php echo $id ?>"><?php echo $name ?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="col-sm-4">
                    <label for="">Puesto</label>
                    <select class="form-select" aria-label="Default select example" id="position" name="position">
                        <option selected disabled value="">Selecciona un puesto</option>
                        <?php     
                            $l_positions_select = $DataBase->read_data_table('positions');
                            while ($row = mysqli_fetch_object($l_positions_select)) {
                                $id = $row->id_position;
                                $name = $row->t_name;
                                ?>
                        <option value="<?php echo $id ?>"><?php echo $name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                <label>Contrato</label>
                <input type="file" class="form-control" id="contract[]" name="contract[]" required>
                </div>
            </div>
            <input type="hidden" name="typeOp" value="3">
            <br>    
          </div>
          <div class="modal-footer">
            
            <button type="submit" class="btn btn-success">Registrar</button>
          </div>
          </form>
        </div>
      </div>
    </div>    
    
    






<?php 
    $l_employees = $DataBase->read_all_employees();
    while ($row = mysqli_fetch_object($l_employees)) {
        $idL = $row->id_employee;
        $employee_info = $DataBase->read_info_employee($idL);
        $employee = mysqli_fetch_object($employee_info);
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
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edición<nav></nav> de Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="post" action="process/update.php" id="formul">
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
                    <input type="file" disabled class="form-control" id="photo" name="photo" >
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
                    <input value="<?php echo $phone_number?>" type="number" class="form-control" id="phone_number" name="phone_number" >
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
                    <div class="col-sm-6">
                    <label>Referencias</label>
                    <textarea class="form-control" name="references" id="references" cols="30" rows="1"><?php echo $references?></textarea>
                    
                    </div>
                </div>
                <br> 
                <div class="row">
                    <center><label for="">Información de trabajo</label></center>
                    <div class="col-sm-4">
                    <label>Cargo</label>
                    <select class="form-select" aria-label="Default select example" id="charge" name="charge">
                        <option disabled value="">Selecciona una área</option>
                        <?php     
                            $l_charges_select = $DataBase->read_data_table('charges');
                            while ($row = mysqli_fetch_object($l_charges_select)) {
                                $idc = $row->id_charge;
                                $namec = $row->t_name;
                                ?>
                        <option value="<?php echo $idc ?>" <?php if($idc == $charge){?> selected <?php }?>><?php echo $namec ?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="">Puesto</label>
                        <select class="form-select" aria-label="Default select example" id="position" name="position">
                            <option selected disabled value="">Selecciona un puesto</option>
                            <?php     
                                $l_positions_select = $DataBase->read_data_table('positions');
                                while ($row = mysqli_fetch_object($l_positions_select)) {
                                    $idp = $row->id_position;
                                    $namep = $row->t_name;
                                    ?>
                            <option value="<?php echo $idp ?>" <?php if($idp == $position){?> selected <?php }?>><?php echo $namep ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                    <label>Contrato</label>
                    <input type="file" disabled class="form-control" id="contract" name="contract" >
                    </div>
                </div>
                <input type="hidden" name="typeOp" value="4">
                <input type="hidden" name="id" value="<?php echo $idL ?>">
                <br>    
            </div>
            <div class="modal-footer">
                
                <button type="submit" class="btn btn-success">Registrar</button>
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
          <form action="process/delete.php" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <input type="hidden" name="typeOp" id="typeOp" value="4">
          
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
        $employee_info = $DataBase->read_info_employee($idL);
$employee = mysqli_fetch_object($employee_info);
$full_name = $employee->t_names." ".$employee->t_last_names;
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
$photo = $employee->fk_img;
$contract = $employee->fk_contract;
$path_c = $DataBase->read_single_record_files($contract)->t_path;
$path_p = $DataBase->read_single_record_files($photo)->t_path;
?>
    <!-- FORMULARIO DE EDICION DE USUARIOS -->
    <div class="modal fade" id="SeeInfoEmployee-<?php echo $idL ?>" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información del Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <center><label for="">Información General</label></center>
                <div class="row">
                    <p>
                        Nombre: <?php echo $full_name?><br>
                        Email: <?php echo $email ?><br>
                        RFC: <?php echo $rfc?><br>
                        NSS: <?php echo $nss?><br>
                        Teléfono: <?php echo $phone_number ?><br>
                        Fecha de Nacimiento: <?php echo $birthday?><br>
                        No. Exterior: <?php echo $no_exterior?><br>
                        No. Interior: <?php echo $no_interior ?><br>
                        Referencias: <?php echo $references ?><br>
                        Calle: <?php echo $street?><br>
                        Colonia: <?php echo $colony?><br>
                        Fotografía: <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$path_p ?>" target="_blank" rel="noopener noreferrer">Click Aqui</a> <br>
                        Contrato: <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$path_c ?>" target="_blank" rel="noopener noreferrer">Click Aqui</a>
                    </p>    
                </div>  
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
            </div>
            </div>
        </div>
    </div>    
<?php } ?>

<?php 
include("components/footer.php");
?>

