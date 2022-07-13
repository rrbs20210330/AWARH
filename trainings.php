<?php
include("components/header.php");
include('config/db.php');
$DataBase = new db();
if($tipo === 2)header('Location: error.php');
require('process/new.php');
require('process/delete.php');
require('process/update.php');
?>

<center><h2>Lista de Capacitaciones</h2></center>

<div class="container">
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#registrousuario">
  Nueva Capacitacion
</button>
<br>
<br>
    <table class="table table-striped table-bordered userTable"style='background: #00252e '>
        <thead style="color: white">
            <th>Nombre</th>
            <th>Empleado</th>
            <th></th>
        </thead>
        <tbody>
            <?php 
                $l_trainings = $DataBase->read_all_trainings();
                while ($row = mysqli_fetch_object($l_trainings)) {
                    $id = $row->id_training;
                    $name = $row->t_name;
                    $employee_name = $row->employee_full_name;
            ?>
            <tr>
                <td>
                    <?php echo $name ?>
                </td>
                <td>
                    <?php echo $employee_name ?>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditTraining-<?php echo $id ?>" ><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger btn-sm " data-bs-toggle="modal" data-bs-target="#DeleteTraining-<?php echo $id ?>"><i class="bi-trash"></i></a>
                    <a class="btn btn-dark btn-sm " data-bs-toggle="modal" data-bs-target="#SeeInfoTraining-<?php echo $id ?>"><i class="bi bi-eye"></i></a>
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
          <form method="post" id="formul" enctype="multipart/form-data" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
            <div class="row">
                <div class="col-sm-6">
                  <label for="">Nombre </label>
                  <input type="text" class="form-control" id="name" name="name" required value="">
                </div>
                <div class="col-sm-6">
                  <label for="">Empleado</label>
                  <select class="form-select" aria-label="Default select example" id="employee" name="employee" required>
                    <?php     
                      $l_employees_select = $DataBase->read_data_table('employees');
                      if(mysqli_num_rows($l_employees_select) === 0 ) { ?>
                      <option selected disabled value="">Necesitas crear un empleado primero</option>
                      <?php } else { ?> <option selected disabled value="">Selecciona un empleado</option><?php } ?>
                      <?php 
                        while ($row = mysqli_fetch_object($l_employees_select)) {
                            $id = $row->id_employee;
                            $name = $row->t_names." ".$row->t_last_names;
                            ?>
                    <option value="<?php echo $id ?>"><?php echo $name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-sm-12">
                  <label for="">Descripcion</label>
                  <textarea class="form-control" id="description" name="description" required rows="1"></textarea>
                </div>
                <div class="col-sm-6">
                    <center><label >Fecha de inicio</label></center>
                    <input type="date" class="form-control" id="date_start" name="date_start" required value="<?php echo $date_start?>">
                </div>
                <div class="col-sm-6">
                    <center><label >Fecha Final</label></center>
                    <input type="date" class="form-control" id="date_finish" name="date_finish" required value="<?php echo $date_finish?>">
                </div>
                <div class="col-sm-12">
                <center><label for="">Archivos</label></center>
                <input type="file" class="form-control" id="file[]" name="file[]" multiple>
                </div>
            </div>
            <br>    
          </div>
          <input type="hidden" name="typeOp" value="8">
          <input type="hidden" name="new" value="1">
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" >Registrar</button>
          </div>
          </form>
        </div>
      </div>
    </div>


<?php 
    $l_trainings = $DataBase->read_all_trainings();
    while ($row = mysqli_fetch_object($l_trainings)) {
        $id_t = $row->id_training;
        $name_t = $row->t_name;
        $description_t = $row->t_description;
        $employee_id_t = $row->employee_id;
        $employee_name_t = $row->employee_full_name;
        $date_start = $row->d_date_start;
        $date_finish = $row->d_date_finish;
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
            <form method="post" id="formul" onsubmit="return confirm('Estás seguro?\nTus datos serán guardados.');">
                <div class="row">
                    <div class="col-sm-6">
                    <label for="">Nombre </label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name_t ?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="">Empleado</label>
                        <select disabled class="form-select" aria-label="Default select example" id="employee" name="employee" data-bs-toggle="tooltip" data-bs-placement="top" title="No se pueden editar el empleado seleccionado">
                            <option selected ><?php echo $employee_name_t ?></option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                    <label for="">Descripcion</label>
                    <textarea class="form-control" id="description" name="description" rows="1"><?php echo $description_t ?></textarea>
                    </div>
                    <div class="col-sm-6">
                        <center><label >Fecha de inicio</label></center>
                        <input type="date" class="form-control" id="date_start" name="date_start" required value="<?php echo $date_start?>">
                    </div>
                    <div class="col-sm-6">
                        <center><label >Fecha Final</label></center>
                        <input type="date" class="form-control" id="date_finish" name="date_finish" required value="<?php echo $date_finish?>">
                    </div>
                    <div class="col-sm-12">
                    <center><label for="">Archivos</label></center>
                    <input type="file" disabled class="form-control" id="file" name="file" data-bs-toggle="tooltip" data-bs-placement="top" title="No se pueden editar los archivos">
                    </div>
                    
                    
                </div>
                <br>    
            </div>
            <div class="modal-footer">
            <input type="hidden" name="id" value="<?php echo $id_t ?>">
                <input type="hidden" name="typeOp" value="2">
                <input type="hidden" name="update" value="1">
                <button type="submit" class="btn btn-success" >Editar</button>
            </div>
            </form>
            </div>
        </div>
        </div>

<?php } ?>

<?php 
  $l_area = $DataBase->read_data_table('trainings');
  while ($row = mysqli_fetch_object($l_area)) {
    $id = $row->id_training;
?>
  <!-- Modal Delete-->
  <div class="modal fade" id="DeleteTraining-<?php echo $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
          <form  method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <input type="hidden" name="typeOp" id="typeOp" value="7">
            <input type="hidden" name="delete" value="1">
            <button type="submit" class="btn btn-danger">Sí, borrar ahora!</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>


<?php 
  $l_trainings = $DataBase->read_data_table('trainings');
  while ($row = mysqli_fetch_object($l_trainings)) {
    $id = $row->id_training;
    $training = $DataBase->read_single_record_training($id);
    $nombre = $training->t_name;
    $descripcion = $training->t_description;
    $date_start = $training->d_date_start;
    $date_finish = $training->d_date_finish;
    $count = $DataBase->count_data_training_files($id);
?>
  <!-- Modal See Info-->
  <div class="modal fade" id="SeeInfoTraining-<?php echo $id ?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Información General</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <b>Nombre de la capacitacion:</b> <?php echo $nombre?><br>
            <b>Descripcion de la capacitacion:</b> <?php echo $descripcion ?><br>
            <b>Periodo de Realización</b><br>
            <b>Inicio:</b> <?php echo $date_start?><br>
            <b>Fin:</b> <?php echo $date_finish?><br>
            <b>Archivos</b> <?php echo $count->count_data; ?> <br><button class="btn btn-success btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Ver mas
            </button>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                  <ul class="list-group">
                    <?php $l_archives = $DataBase->read_data_table_files_trainings($id);
                    while($row = mysqli_fetch_object($l_archives)){
                      $idfile = $row->fk_file;
                      $infofile = $DataBase->read_single_record_files($idfile);
                      ?>
                    <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/AWARH/'.$infofile->t_path ?>" target="_blank"><li class="list-group-item"><?php echo $infofile->t_name ?></li></a> 
                    <?php } ?>
                  </ul>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<script>
  var elemento = document.getElementById('training_list');
elemento.classList.add("active");
</script>
<?php
include("components/footer.php");
?>

