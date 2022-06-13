<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
?>

<center><h2>Lista de Capacitaciones</h2></center>

<div class="container">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registrousuario">
  Nueva Capacitacion
</button>
    <table class="table table-bordered"  id="userTable">
        <thead>
            <th>Nombre</th>
            <th>Empleado</th>
            <th>Fecha de realización</th>
            <th></th>
        </thead>
        <tbody>
            <?php 
                $l_trainings = $DataBase->read_all_trainings();
                while ($row = mysqli_fetch_object($l_trainings)) {
                    $id = $row->id;
                    $name = $row->name;
                    $employee_name = $row->employee_full_name;
                    $date = $row->date_realization;
            ?>
            <tr>
                <td>
                    <?php echo $name ?>
                </td>
                <td>
                    <?php echo $employee_name ?>
                </td>
                <td>
                    <?php echo $date ?>
                </td>
                <td>
                    <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#EditTraining-<?php echo $id ?>" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm "href="process/delete.php?id=<?php echo $id?>&table=training&location=training"><i class="bi-trash"></i></a>
                </td>
            </tr>  
            <?php }?>
        </tbody>
    </table>
</div>

<!-- FORMULARIO DE REGISTRO DE USUARIOS -->
<div class="modal fade" id="registrousuario" tabindex="-1"  aria-hidden="true">
    <?php ?>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registro de Capacitaciones</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="process/new.php" method="post" id="formul">
            <div class="row">
                <div class="col-sm-4">
                <label for="">Nombre </label>
                <input type="text" class="form-control" id="name" name="name" required value="">
                </div>
                <div class="col-sm-4">
                <label for="">Descripcion</label>
                <input type="text" class="form-control" id="description" name="description" required>
                </div>
                <div class="col-sm-4">
                <label for="">Archivos</label>
                <input type="file" class="form-control" id="file" name="file" required>
                </div>
                <div class="col-sm-4">
                <label for="">Empleado</label>
                <select class="form-select" aria-label="Default select example" id="employee" name="employee">
                <option selected>Selecciona una área</option>
                <?php     
                    $l_employees_select = $DataBase->read_data_table('employees');
                    while ($row = mysqli_fetch_object($l_employees_select)) {
                        $id = $row->id;
                        $name = $row->names." ".$row->last_names;
                        ?>
                <option value="<?php echo $id ?>"><?php echo $name ?></option>
                <?php } ?>
            </select>
                </div>
                <div class="col-sm-4">
                <label for="">Fecha de realización</label>
                <input type="date" class="form-control" id="date_realization" name="date_realization" required>
                </div>
            </div>
            <br>    
          </div>
          <div class="modal-footer">
            <input type="hidden" name="typeOp" value="2">
            <button type="submit" class="btn btn-success">Registrar</button>
          </div>
          </form>
        </div>
      </div>
    </div>


<?php 
    $l_trainings = $DataBase->read_all_trainings();
    while ($row = mysqli_fetch_object($l_trainings)) {
        $id_t = $row->id;
        $name_t = $row->name;
        $description_t = $row->description;
        $employee_id_t = $row->employee_id;
        $employee_name_t = $row->employee_full_name;
        $date_t = $row->date_realization;
?>
    <!-- FORMULARIO DE EDICION DE CAPACITACIONES -->
    <div class="modal fade" id="EditTraining-<?php echo $id_t ?>" tabindex="-1"  aria-hidden="true">
        <?php ?>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edición de Capacitación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="process/update.php" method="post" id="formul">
                <div class="row">
                    <div class="col-sm-4">
                    <label for="">Nombre </label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name_t ?>">
                    </div>
                    <div class="col-sm-4">
                    <label for="">Descripcion</label>
                    <input type="text" class="form-control" id="description" name="description" value="<?php echo $description_t ?>">
                    </div>
                    <div class="col-sm-4">
                    <label for="">Archivos</label>
                    <input type="file" class="form-control" id="file" name="file">
                    </div>
                    <div class="col-sm-4">
                    <label for="">Empleado</label>
                    <select class="form-select" aria-label="Default select example" id="employee" name="employee" value="<?php echo $employee_id_t ?>">
                    <option>Selecciona una área</option>
                    <?php     
                        $l_employees_select = $DataBase->read_data_table('employees');
                        while ($row = mysqli_fetch_object($l_employees_select)) {
                            $id = $row->id;
                            $name = $row->names." ".$row->last_names;
                            ?>
                    <option value="<?php echo $id ?>" <?php if($id == $id_t){ ?> selected <?php }?>><?php echo $name ?></option>
                    <?php } ?>
                </select>
                    </div>
                    <div class="col-sm-4">
                    <label for="">Fecha de realización</label>
                    <input type="date" class="form-control" id="date_realization" name="date_realization" value="<?php echo $date_t?>">
                    </div>
                </div>
                <br>    
            </div>
            <div class="modal-footer">
            <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="hidden" name="typeOp" value="2">
                <button type="submit" class="btn btn-success">Registrar</button>
            </div>
            </form>
            </div>
        </div>
        </div>

<?php }
include("components/footer.php");
?>

