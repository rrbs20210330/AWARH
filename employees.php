<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
?>

<center><h2>Lista de Empleados</h2></center>

<div class="container">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registroempleado">
  Nuevo Empleado
</button>
    <table class="table table-bordered"  id="userTable">
        <thead>
            <th>Activo</th>
            <th>Nombre Completo</th>
            <th>Telefono</th>
            <th>Correo Electronico</th>
            <th></th>
            
        </thead>
        <tbody>
            <?php 
                $l_employees = $DataBase->read_all_employees();
                while ($row = mysqli_fetch_object($l_employees)) {
                    $id = $row->id;
                    $active = $row->active;
                    $fullname = $row->names." ".$row->last_names;
                    $email = $row->email;
                    $phone_number = $row->phone_number;
            ?>
            <tr>
                <td>
                    <?php if ($active == 0){
                      ?>
                    <a class="btn btn-secondary btn-sm" href="process/update.php?id=<?php echo $id?>&table=employees&location=employees"><i class="bi bi-circle"></i></a>
                    <?php

                    }else{?>
                    <a class="btn btn-success btn-sm" href="process/update.php?id=<?php echo $id?>&table=employees&location=employees"><i class="bi bi-circle-fill"></i></a>
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
                    <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#EditEmployee-<?php $id ?>" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm "href="process/delete.php?id=<?php echo $id?>&typeOp=4"><i class="bi-trash"></i></a>
                    <a class="btn btn-primary btn-sm "href="employee.php?id=<?php echo $id?>"><i class="bi bi-eye"></i></a>
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
          <form method="post" action="process/new.php" id="formul">
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
                <label >Fotografia</label>
                <input type="file" class="form-control" id="photo" name="photo" required>
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
                <label>Telefono </label>
                <input type="number" class="form-control" id="phone_number" name="phone_number" required value="">
                </div>
                <div class="col-sm-6">
                <label >Correo Electronico</label>
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
                <label>Numero Exterior</label>
                <input type="number" class="form-control" id="no_exterior" name="no_exterior" required>
                </div>
                <div class="col-sm-4">
                <label >Numero Interior</label>
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
                <center><label for="">Informacion de trabajo</label></center>
                <div class="col-sm-4">
                <label>Cargo</label>
                <select class="form-select" aria-label="Default select example" id="charge" name="charge">
                    <option selected>Selecciona una área</option>
                    <?php     
                        $l_charges_select = $DataBase->read_data_table('charges');
                        while ($row = mysqli_fetch_object($l_charges_select)) {
                            $id = $row->id;
                            $name = $row->name;
                            ?>
                    <option value="<?php echo $id ?>"><?php echo $name ?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="col-sm-4">
                    <label for="">Puesto</label>
                    <select class="form-select" aria-label="Default select example" id="position" name="position">
                        <option selected>Selecciona un puesto</option>
                        <?php     
                            $l_positions_select = $DataBase->read_data_table('positions');
                            while ($row = mysqli_fetch_object($l_positions_select)) {
                                $id = $row->id;
                                $name = $row->name;
                                ?>
                        <option value="<?php echo $id ?>"><?php echo $name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                <label>Contrato</label>
                <input type="file" class="form-control" id="contract" name="contract" required>
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
    
    







<!-- FORMULARIO DE REGISTRO DE USUARIOS -->
<div class="modal fade" id="EditEmployee-<?php echo $id ?>" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo de Empleado</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form method="post" action="process/new.php" id="formul">
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
                <label >Fotografia</label>
                <input type="file" class="form-control" id="photo" name="photo" required>
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
                <label>Telefono </label>
                <input type="number" class="form-control" id="phone_number" name="phone_number" required value="">
                </div>
                <div class="col-sm-6">
                <label >Correo Electronico</label>
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
                <label>Numero Exterior</label>
                <input type="number" class="form-control" id="no_exterior" name="no_exterior" required>
                </div>
                <div class="col-sm-4">
                <label >Numero Interior</label>
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
                <center><label for="">Informacion de trabajo</label></center>
                <div class="col-sm-4">
                <label>Cargo</label>
                <select class="form-select" aria-label="Default select example" id="charge" name="charge">
                    <option selected>Selecciona una área</option>
                    <?php     
                        $l_charges_select = $DataBase->read_data_table('charges');
                        while ($row = mysqli_fetch_object($l_charges_select)) {
                            $id = $row->id;
                            $name = $row->name;
                            ?>
                    <option value="<?php echo $id ?>"><?php echo $name ?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="col-sm-4">
                    <label for="">Puesto</label>
                    <select class="form-select" aria-label="Default select example" id="position" name="position">
                        <option selected>Selecciona un puesto</option>
                        <?php     
                            $l_positions_select = $DataBase->read_data_table('positions');
                            while ($row = mysqli_fetch_object($l_positions_select)) {
                                $id = $row->id;
                                $name = $row->name;
                                ?>
                        <option value="<?php echo $id ?>"><?php echo $name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                <label>Contrato</label>
                <input type="file" class="form-control" id="contract" name="contract" required>
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
include("components/footer.php");
?>

